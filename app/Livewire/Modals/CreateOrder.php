<?php

namespace App\Livewire\Modals;

use App\Events\OrderCreated;
use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CreateOrder extends Component
{
    public ContactForm $newContact;

    public int $step = 1;

    // Customer Selection
    public string $customerSelectionType = 'existing';

    public $contact_id = '';

    // Order Info
    public $status = 'Pending';

    public $address = '';

    public $delivery_charge = 0;

    public $items = [
        ['product_id' => '', 'quantity' => 1, 'price' => 0],
    ];

    // Invoice Info
    public bool $generate_invoice = false;

    public string $invoice_template = 'simple';

    #[Computed]
    public function contacts()
    {
        return Contact::orderBy('name')->get();
    }

    #[Computed]
    public function products()
    {
        return Product::orderBy('name')->get();
    }

    public function addItem()
    {
        $this->items[] = ['product_id' => '', 'quantity' => 1, 'price' => 0];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function selectContact($id, $address)
    {
        if ($id) {
            $this->contact_id = $id;
            $this->address = $address;
        }
    }

    // Superseded by updateItemProduct for custom dropdown
    public function updateItemProduct($index, $productId)
    {
        $this->items[$index]['product_id'] = $productId;
        $product = Product::find($productId);
        if ($product) {
            $this->items[$index]['price'] = (int) $product->retail_price; // Casting to int as requested
        }
    }

    #[Computed]
    public function itemsTotal()
    {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += ((int) $item['quantity'] * (int) $item['price']);
        }

        return $subtotal;
    }

    #[Computed]
    public function total()
    {
        return $this->itemsTotal + (int) ($this->delivery_charge ?: 0);
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validateStep1();
        } elseif ($this->step === 2) {
            $this->validateStep2();
        }

        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    protected function validateStep1()
    {
        if ($this->customerSelectionType === 'existing') {
            $this->validate([
                'contact_id' => 'required|exists:contacts,id',
            ]);
        } else {
            $this->validate([
                'newContact.name' => 'required|string|max:255',
                'newContact.email' => 'nullable|email|max:255|unique:contacts,email',
                'newContact.phone' => 'nullable|string|max:20',
                'newContact.address' => 'nullable|string',
            ]);
        }
    }

    protected function validateStep2()
    {
        $this->validate([
            'status' => 'required|in:Pending,Processing,Completed',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'delivery_charge' => 'nullable|integer|min:0',
            'address' => 'nullable|string',
        ]);
    }

    public function save()
    {
        if ($this->customerSelectionType === 'new') {
            $contact = Contact::create([
                'name' => $this->newContact->name,
                'email' => $this->newContact->email,
                'phone' => $this->newContact->phone,
                'address' => $this->newContact->address,
                'landmark' => $this->newContact->landmark,
                'whatsapp_no' => $this->newContact->whatsapp_no,
            ]);
            $this->contact_id = $contact->id;
        }

        $this->validateStep1();
        $this->validateStep2();

        $order = Order::create([
            'contact_id' => $this->contact_id,
            'status' => $this->status,
            'total_amount' => $this->total,
            'delivery_charge' => $this->delivery_charge ?: 0,
            'address' => $this->address,
        ]);

        foreach ($this->items as $item) {
            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'sale_price' => $item['price'],
            ]);
        }

        // Dispatch the Order created event
        OrderCreated::dispatch($order, $this->generate_invoice);

        $this->reset(['contact_id', 'items', 'status', 'delivery_charge', 'address', 'step', 'customerSelectionType', 'generate_invoice', 'invoice_template']);
        $this->items = [['product_id' => '', 'quantity' => 1, 'price' => 0]];

        Flux::modal('create-order')->close();

        $this->dispatch('order-created');
        $this->dispatch('toast', variant: 'success', heading: 'Order Created', text: 'The order has been created successfully.');
    }

    public function render()
    {
        return view('livewire.modals.create-order');
    }
}
