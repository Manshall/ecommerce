<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart - Warung Mae')]
class CartPage extends Component
{
    public $cart;
    public $cart_items = [];
    public $grand_total;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }
    public function removeItem($product_id)
    {
        // Hapus item dari keranjang
        $this->cart_items = CartManagement::removeCartItem($product_id);

        // Hitung ulang grand total
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        // Hitung jumlah total item di cart
        $total_count = count($this->cart_items);

        // Kirim event untuk update jumlah item di navbar
        $this->dispatch('updateCartCount', $total_count)->to(Navbar::class);
    }

    public function increaseQty($product_id){   
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($product_id){
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}