<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
// use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Product Detail - Kotor')]

class ProductDetailPage extends Component
{

    public $slug;
    public $quantity = 1;

    public function increaseQty()
    {
        $this->quantity++;  // Menambah 1 pada kuantitas setiap kali dipanggil
    }

    public function decreaseQty()
    {
        if($this->quantity > 1){
            $this->quantity--;
        }
    }

    // Menambahkan produk ke keranjang
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_countId: $total_count);

       // Benar
// $this->alert('success', 'Product added to the cart successfully!', [
//     'position' => 'bottom-end',
//     'timer' => 3000,
//     'toast' => true,
// ]);

    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        // Menampilkan data produk berdasarkan slug
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
