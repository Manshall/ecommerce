<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{ $title ?? 'Warung Mae' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Include Livewire Styles -->
  @livewireStyles
</head>

<body class="bg-slate-200 dark:bg-slate-700">
  @livewire('partials.navbar')

  <main>
    {{ $slot }}
  </main>

  @livewire('partials.footer')

  <!-- Include Livewire Scripts -->
  @livewireScripts

  <!-- SweetAlert2 Script -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Add Filament app.js -->
  <script src="{{ asset('js/filament/filament/app.js') }}"></script>

  <!-- Materialize and Mousetrap initialization -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (typeof M !== 'undefined' && M.AutoInit) {
        M.AutoInit(); // Initialize Materialize components
      } else {
        console.error('Materialize did not load properly.');
      }
    });
  </script>

  @stack('scripts') <!-- Stack for additional scripts -->
</body>

</html>
