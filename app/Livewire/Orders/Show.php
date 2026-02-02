<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Order $order;

    // State for searching/adding products
    public $searchProduct = '';

    public $isAddingProduct = false;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function updateStatus($status)
    {
        // Prevent updates if status is same
        if ($this->order->status === $status) {
            return;
        }

        $this->order->update(['status' => $status]);
        $this->order->logActivity("Status updated to $status");

        $this->dispatch('toast', message: "Order status updated to $status", type: 'success');
    }

    public function deleteOrder()
    {
        $this->order->delete();
        $this->redirect(route('orders'), navigate: true);
        $this->dispatch('toast', message: 'Order deleted successfully', type: 'success');
    }

    #[Computed]
    public function searchResults()
    {
        if (strlen($this->searchProduct) < 2) {
            return [];
        }

        return Product::query()
            ->where('name', 'like', '%'.$this->searchProduct.'%')
            ->whereNotIn('id', $this->order->products->pluck('id'))
            ->limit(5)
            ->get();
    }

    public function addProduct(Product $product)
    {
        // Add to pivot with default quantity 1 and current sale price
        $this->order->products()->attach($product->id, [
            'quantity' => 1,
            'unit_cost' => $product->purchase_price ?? 0,
            'sale_price' => $product->retail_price ?? $product->sale_price,
            'subtotal' => $product->retail_price ?? $product->sale_price,
        ]);

        $this->recalculateTotal();
        $this->searchProduct = '';
        $this->dispatch('toast', message: 'Product added to order', type: 'success');
    }

    public function removeProduct($productId)
    {
        $this->order->products()->detach($productId);
        $this->recalculateTotal();
        $this->dispatch('toast', message: 'Product removed from order', type: 'success');
    }

    public function incrementQuantity($productId)
    {
        $pivot = $this->order->products()->where('product_id', $productId)->first()->pivot;
        $this->order->products()->updateExistingPivot($productId, [
            'quantity' => $pivot->quantity + 1,
        ]);
        $this->recalculateTotal();
    }

    public function decrementQuantity($productId)
    {
        $pivot = $this->order->products()->where('product_id', $productId)->first()->pivot;
        if ($pivot->quantity > 1) {
            $this->order->products()->updateExistingPivot($productId, [
                'quantity' => $pivot->quantity - 1,
            ]);
            $this->recalculateTotal();
        }
    }

    public function recalculateTotal()
    {
        $this->order->refresh();
        $subtotal = 0;
        foreach ($this->order->products as $product) {
            $lineSubtotal = $product->pivot->quantity * $product->pivot->sale_price;

            // Update the pivot subtotal if it's not already correct
            if ($product->pivot->subtotal != $lineSubtotal) {
                $this->order->products()->updateExistingPivot($product->id, [
                    'subtotal' => $lineSubtotal,
                ]);
            }

            $subtotal += $lineSubtotal;
        }

        $deliveryCharge = $this->order->delivery_charge;
        $taxAmount = $this->order->tax_amount ?? 0;
        $discountAmount = $this->order->discount_amount ?? 0;

        $total = $subtotal + $deliveryCharge + $taxAmount - $discountAmount;

        $this->order->update([
            'subtotal_amount' => $subtotal,
            'total_amount' => $total,
        ]);
    }

    public function render()
    {
        return view('livewire.orders.show');
    }
}
