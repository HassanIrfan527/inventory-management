<?php

namespace App\Livewire\Settings;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProductCategories extends Component
{
    public $categories = [];

    public $name = '';

    public $editingId = null;

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = \App\Models\Category::orderBy('name')->get();
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories,name|min:2',
        ]);

        \App\Models\Category::create(['name' => $this->name]);

        $this->name = '';
        $this->loadCategories();
        $this->dispatch('toast', type: 'success', message: 'Category added successfully.');
    }

    public function updateCategory($id, $newName)
    {
        $category = \App\Models\Category::find($id);

        if ($category) {
            // Only update if name changed and is valid
            if ($category->name !== $newName && ! empty($newName)) {
                $this->validate([
                    'categories.*.name' => 'required|min:2|unique:categories,name,'.$id,
                ]);

                $category->update(['name' => $newName]);
                $this->dispatch('toast', type: 'success', message: 'Category updated.');
            }
        }
        $this->loadCategories();
    }

    public function deleteCategory($id)
    {
        $category = \App\Models\Category::find($id);
        if ($category) {
            $category->delete();
            $this->loadCategories();
            $this->dispatch('toast', type: 'success', message: 'Category deleted.');
        }
    }

    public function render()
    {
        return view('livewire.settings.product-categories');
    }
}
