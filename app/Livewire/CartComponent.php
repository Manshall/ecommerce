<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class CartComponent extends Component
{
    public $cart_items = [];

    public function mount()
    {
        // Mengambil item keranjang dari session
        $this->cart_items = session()->get('cart', []);
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        // Cek apakah produk sudah ada di keranjang
        if (isset($cart[$productId])) {
            // Jika ada, tambahkan kuantitasnya
            $cart[$productId]['quantity']++;
            $cart[$productId]['total_amount'] = $cart[$productId]['quantity'] * $product->price;
        } else {
            // Jika tidak ada, tambahkan produk baru ke keranjang
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'total_amount' => $product->price,
            ];
        }

        // Menyimpan kembali ke session
        session()->put('cart', $cart);
        $this->cart_items = $cart;
    }

    public function removeItem($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->cart_items = $cart;
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
