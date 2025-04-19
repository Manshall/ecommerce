<header class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white-800 text-sm py-3 md:py-0 dark:bg-white opacity-70    shadow-md">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
      <div class="relative md:flex md:items-center md:justify-between">
        <div class="flex items-center justify-between">
          <a class="flex-none text-xl font-semibold dark:text-gray-800" href="/" aria-label="Brand">Westside</a>
          <div class="md:hidden">
            <button type="button" class="hs-collapse-toggle flex justify-center items-center w-9 h-9 rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
              <svg class="hs-collapse-open:hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <svg class="hs-collapse-open:block hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
        <div id="navbar-collapse-with-animation" class="hs-collapse hidden transition-all duration-300 md:block">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:gap-x-7 mt-5 md:mt-0">

              <a class="font-medium text-black-500 hover:text-black-400 py-3 md:py-6 dark:text-black-400 dark:hover:text-black-500 text-2xl" href="/">Beranda</a>
              <a class="font-medium text-black-500 hover:text-black-400 py-3 md:py-6 dark:text-black-400 dark:hover:text-black-500 text-2xl" href="/categories">Kategori</a>
              <a class="font-medium text-black-500 hover:text-black-400 py-3 md:py-6 dark:text-black-400 dark:hover:text-black-500 text-2xl" href="/products">Produk</a>

              <a wire:navigate class="font-medium flex items-center text-black-500 hover:text-black-400 py-3 md:py-6 dark:text-black-400 dark:hover:text-black-500" href="/cart">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12a1.125 1.125 0 0 1-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974a1.125 1.125 0 0 1 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="mr-1 text-2xl">Keranjang</span>
                <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">{{ $total_count }}</span>
              </a>

              @auth
              <div class="relative hs-dropdown md:[--trigger:hover] md:py-4 text-2xl">
                <button type="button" class="flex items-center gap-x-1 text-gray-700 hover:text-gray-900 font-medium dark:text-gray-300 dark:hover:text-white">
                  {{ Auth::user()->name }}
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6" />
                  </svg>
                </button>

                <!-- Dropdown Menu -->
                <div class="hs-dropdown-menu z-50 mt-2 w-44 bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 absolute hidden">
                  <a wire:navigate href="/my-orders" class="block px-3 py-2 text-sm rounded-md text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                    Pesanan Saya
                  </a>
                  <a href="/account" class="block px-3 py-2 text-sm rounded-md text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                    Akun Saya
                  </a>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm rounded-md text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                      Keluar
                    </button>
                  </form>
                </div>
              </div>
              @else
              <div class="pt-3 md:pt-0">
                <a href="/login" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                  </svg>
                  Masuk
                </a>
              </div>
              @endauth
            </div>
          </div>
        </div>
    </nav>
</header>
