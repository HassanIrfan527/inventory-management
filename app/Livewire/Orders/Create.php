<?php

namespace App\Livewire\Orders;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Create Order')]
class Create extends Component
{
    // Step State
    public int $step = 1;

    // Step 1: Customer
    public string $customer_type = 'existing'; // existing or new

    public $contact_id = '';

    // New Customer State
    public $new_customer_name = '';

    public $new_customer_email = '';

    public $new_customer_phone = '';

    public $new_customer_address = '';

    // Step 2: Items
    public array $items = [
        ['product_id' => '', 'quantity' => 1, 'price' => 0],
    ];

    public $discount = 0;

    public $tax_rate = 0;

    // Step 3: Logistics & Review
    public $status = 'Pending';

    public $payment_status = 'UNPAID';

    public $payment_method = 'CASH';

    public $source = 'MANUAL';

    public $address = ''; // Delivery Address

    public $delivery_charge = 0;

    public $customer_notes = '';

    public $internal_notes = '';

    public function mount()
    {
        // Initialize with one empty item
    }

    // --- Computed Properties ---

    #[Computed]
    public function contacts()
    {
        return Cache::remember('contacts:all:'.auth()->id(), now()->addMinutes(30), function () {
            return Contact::orderBy('first_name')->get();
        });
    }

    #[Computed]
    public function products()
    {
        return Cache::remember('products:all:'.auth()->id(), now()->addMinutes(30), function () {
            return Product::orderBy('name')->get();
        });
    }

    #[Computed]
    public function subtotal()
    {
        $sub = 0;
        foreach ($this->items as $item) {
            $sub += (float) ($item['quantity'] ?? 0) * (float) ($item['price'] ?? 0);
        }

        return $sub;
    }

    #[Computed]
    public function total()
    {
        $tax = $this->subtotal * ($this->tax_rate / 100);

        return $this->subtotal + $this->delivery_charge + $tax - $this->discount;
    }

    // --- Actions ---

    public function addItem()
    {
        $this->items[] = ['product_id' => '', 'quantity' => 1, 'price' => 0];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updateItemProduct($index, $productId)
    {
        $this->items[$index]['product_id'] = $productId;
        $product = Product::find($productId);
        if ($product) {
            $this->items[$index]['price'] = $product->retail_price ?? $product->sale_price;
        }
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function setCustomerType($type)
    {
        $this->customer_type = $type;
    }

    public function selectContact($id)
    {
        $this->contact_id = $id;
        $contact = Contact::find($id);
        if ($contact) {
            $this->address = $contact->address;
        }
    }

    // --- Validation ---

    protected function validateStep()
    {
        if ($this->step === 1) {
            if ($this->customer_type === 'existing') {
                $this->validate([
                    'contact_id' => 'required|exists:contacts,id',
                ]);
            } else {
                $this->validate([
                    'new_customer_name' => 'required|string|min:3',
                    'new_customer_phone' => 'required|string', // Relaxed for wizard
                ]);
            }
        } elseif ($this->step === 2) {
            $this->validate([
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.price' => 'required|numeric|min:0',
            ]);
        }
    }

    public function save(\App\Services\OrderService $orderService, \App\Services\ContactService $contactService)
    {
        $this->validateStep(); // Final step validation

        $contactId = $this->contact_id;

        if ($this->customer_type === 'new') {
            $contact = $contactService->createContact([
                'first_name' => $this->new_customer_name,
                'email' => $this->new_customer_email,
                'phone' => $this->new_customer_phone,
                'address' => $this->new_customer_address,
            ]);
            $contactId = $contact->id;
        }

        $order = $orderService->createOrder(
            contactId: (int) $contactId,
            status: strtoupper($this->status),
            items: $this->items,
            deliveryCharge: (int) $this->delivery_charge,
            address: $this->address
        );

        session()->flash('success', 'Order created successfully.');

        return redirect()->route('orders');
    }

    public function render()
    {
        return view('livewire.orders.create');
    }
}
