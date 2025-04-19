<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Brand;
use App\Models\Category;

#[Title('Products - Warung Mae')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url] public $selected_categories = [];
    #[Url] public $selected_brands = [];
    #[Url] public $featured = [];
    #[Url] public $on_sale = [];
    #[Url] public $price_range = 300000;
    #[Url] public $sort = 'latest';

    public function addToCart($product_id)
    {
        // ✅ Sudah dibetulkan: sekarang pakai addItemToCart() yang default quantity = 1
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_countId: $total_count);

        LivewireAlert::success(
            'Berhasil!',
            'Produk berhasil ditambahkan ke keranjang',
            [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
            ]
        );
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        if ($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        $products = $productQuery->with(['category', 'brand'])->paginate(9);

        return view('livewire.products-page', [
            'products' => $products,
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
