<?php

namespace App\Livewire\Modals;

use App\Events\OrderCreated;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;
class CreateOrder extends Component
{
    public $contact_id = '';

    public $status = 'Pending';
    public $address = '';

    public $delivery_charge = 0;

    public $items = [
        ['product_id' => '', 'quantity' => 1, 'price' => 0],
    ];

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

    public function save()
    {
        $this->validate([
            'contact_id' => 'required|exists:contacts,id',
            'status' => 'required|in:Pending,Processing,Completed',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0', // Enforce integer
            'delivery_charge' => 'nullable|integer|min:0', // Enforce integer
            'address' => 'nullable|string',
        ]);

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
        OrderCreated::dispatch($order);

        $this->reset(['contact_id', 'items', 'status', 'delivery_charge', 'address']);
        $this->items = [['product_id' => '', 'quantity' => 1, 'price' => 0]];

        Flux::modal('create-order')->close();
        $this->dispatch('order-created'); // Assuming parent listens to this
    }


    public function render()
    {
        return view('livewire.modals.create-order');
    }
}
