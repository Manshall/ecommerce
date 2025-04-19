<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
      <h1 class="text-2xl font-semibold mb-6 text-black">Shopping Cart</h1>

      <div class="flex flex-col md:flex-row gap-6">
        <!-- Cart Items -->
        <div class="md:w-3/4">
          <div class="dark:bg-blue-300 dark:bg-white-800 overflow-x-auto rounded-lg shadow-md p-6 mb-4">
            <table class="w-full text-left">
              <thead>
                <tr class="text-sm text-black-600 dark:text-black border-b">
                  <th class="pb-3">Product</th>
                  <th class="pb-3">Price</th>
                  <th class="pb-3">Quantity</th>
                  <th class="pb-3">Total</th>
                  <th class="pb-3">Remove</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cart_items as $item)
                  <tr wire:key="{{ $item['product_id'] }}" class="border-b last:border-none">
                    <td class="py-4">
                      <div class="flex items-center">
                        <img src="{{ url('storage', $item['image']) }}" class="w-16 h-16 rounded mr-4" alt="{{ $item['name'] }}">
                        <span class="font-semibold text-gray-800 dark:text-black">{{ $item['name'] }}</span>
                      </div>
                    </td>
                    <td class="py-4 text-gray-700 dark:text-black">
                      {{ Number::currency($item['unit_amount'], 'IDR') }}
                    </td>
                    <td class="py-4">
                      <div class="flex items-center">
                        <button wire:click="decreaseQty({{ $item['product_id'] }})" class="border px-3 py-1 rounded hover:bg-white-100 dark:hover:bg-white   text-black">-</button>
                        <span class="mx-2 w-8 text-center text-black">{{ $item['quantity'] }}</span>
                        <button wire:click="increaseQty({{ $item['product_id'] }})" class="border px-3 py-1 rounded hover:bg-white-100 dark:hover:bg-white text-black">+</button>
                      </div>
                    </td>
                    <td class="py-4 text-gray-700 dark:text-black">
                      {{ Number::currency($item['total_amount'], 'IDR') }}
                    </td>
                    <td class="py-4">
                      <button wire:click="removeItem({{ $item['product_id'] }})"
                        class="px-3 py-1 rounded-lg bg-slate-300 border-2 border-slate-400 hover:bg-red-500 hover:text-white hover:border-red-700 transition-all">
                        <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">Remove</span>
                        <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">Removing...</span>
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-6 text-xl font-semibold text-slate-500">
                      No items available in cart!
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Summary -->
        <div class="md:w-1/4">
          <div class="dark:bg-blue-300 dark:bg-white-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4 text-black-800 dark:text-black">Summary</h2>

            <div class="flex justify-between mb-2 text-white-700 dark:text-black">
              <span>Subtotal</span>
              <span>{{ Number::currency($grand_total, 'IDR') }}</span>
            </div>
            <div class="flex justify-between mb-2 text-white-700 dark:text-black">
              <span>Taxes</span>
              <span>{{ Number::currency(0, 'IDR') }}</span>
            </div>
            <div class="flex justify-between mb-2 text-bck-700 dark:text-black">
              <span>Shipping</span>
              <span>{{ Number::currency(0, 'IDR') }}</span>
            </div>
            <hr class="my-2 border-white-300 dark:border-black">
            <div class="flex justify-between mb-4 text-white-800 dark:text-black font-semibold">
              <span>Grand Total</span>
              <span>{{ Number::currency($grand_total, 'IDR') }}</span>
            </div>

            @if ($cart_items && count($cart_items) > 0)
              <a href="/checkout" class="block bg-blue-600 hover:bg-blue-700 text-black text-center py-2 rounded-lg transition-all">
                Checkout
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>