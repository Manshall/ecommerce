<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // Tambahkan item ke keranjang (default 1 qty)
    public static function addItemToCart($product_id)
    {
        return self::addItemToCartWithQty($product_id, 1);
    }

    // Tambahkan item ke keranjang dengan jumlah tertentu
    public static function addItemToCartWithQty($itemId, $quantity)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item_key = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $itemId) {
                $existing_item_key = $key;
                break;
            }
        }

        if ($existing_item_key !== null) {
            // Jika item sudah ada, tambahkan jumlahnya
            $cart_items[$existing_item_key]['quantity'] += $quantity;
            $cart_items[$existing_item_key]['total_amount'] =
                $cart_items[$existing_item_key]['quantity'] * $cart_items[$existing_item_key]['unit_amount'];
        } else {
            // Ambil data produk dari database
            $product = Product::find($itemId);
            if ($product) {
                $image = is_array($product->images) && isset($product->images[0]) ? $product->images[0] : 'default.jpg';

                $cart_items[] = [
                    'product_id'   => $itemId,
                    'name'         => $product->name,
                    'image'        => $image,
                    'quantity'     => $quantity,
                    'unit_amount'  => $product->price,
                    'total_amount' => $product->price * $quantity,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // Hapus item dari keranjang
    public static function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        $cart_items = array_values($cart_items); // Re-index array
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Tambahkan item ke cookie
    public static function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // Hapus semua item dari cookie
    public static function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // Ambil semua item dari cookie
    public static function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        return $cart_items ?: [];
    }

    // Tambah kuantitas item
    public static function incrementQuantityToCartItem($product_id)
    {
        return self::addItemToCartWithQty($product_id, 1);
    }

    // Kurangi kuantitas item
    public static function decrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && $cart_items[$key]['quantity'] > 1) {
                $cart_items[$key]['quantity']--;
                $cart_items[$key]['total_amount'] =
                    $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Hitung total keseluruhan
    public static function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}
