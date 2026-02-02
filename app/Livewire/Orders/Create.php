<?php

namespace App\Livewire\Orders;

use App\Models\Contact;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
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
        return Contact::orderBy('first_name')->get();
    }

    #[Computed]
    public function products()
    {
        return Product::orderBy('name')->get();
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

    public function save()
    {
        // Logic will be implemented later as requested
    }

    public function render()
    {
        return view('livewire.orders.create');
    }
}
