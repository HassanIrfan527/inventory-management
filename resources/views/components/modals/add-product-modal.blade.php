<flux:modal name="add-product" flyout variant="floating" class="space-y-6">
    <div>
        <flux:heading size="lg">Add Product</flux:heading>
        <flux:subheading>Add a new product to your inventory.</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <!-- Modal slot where parent will inject the form -->
    {{ $slot }}

</flux:modal>
