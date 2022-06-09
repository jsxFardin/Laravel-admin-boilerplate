<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3">
  <a class="navbar-brand" href="#" style="color:#222d32;'">
      <i class="@yield('icon_page') d-inline-block"></i> @yield('title')
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
      aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
          @yield('menu_pagina')
      </ul>
  </div>
</nav>