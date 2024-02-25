<div class="container-fluid text-bg-white py-3">
  <div class="d-flex justify-content-between align-items-center">

    {{-- Left --}}
    <div>
      <div class="d-flex align-items-center">
        <div class="me-3">
          <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebarMenu" aria-controls="offcanvasSidebarMenu">
            <i class="bi bi-list"></i>
          </button>
        </div>
        <div class="lh-1">
          <b class="d-block mb-1">{{ $settings->get('company_name') }}</b>
          <small>{{ now()->toFormattedDayDateString() }}</small>
        </div>
      </div>
    </div>

    {{-- Center --}}
    <div class="d-none d-lg-inline-block">
      @include('components.application.search')
    </div>

    {{-- Right --}}
    <div class="text-end">
      <x-dropdown button="Username">
        <x-slot name="button">
          <i class="bi bi-person-circle"></i>
          <span class="d-none d-md-inline-block ms-1">{{ auth()->user()->profile_name }}</span>
        </x-slot>

        <li class="d-block d-md-none text-center">
          <b class="dropdown-header">{{ auth()->user()->profile_name }}</b>
          <hr class="dropdown-divider">
        </li>

        <li>          
          <x-application.button-theme-mode class="dropdown-item" />
        </li>

        <li class="d-none d-md-block">
          <x-application.button-theme-width class="dropdown-item" />
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item" href="#">
          <i class="bi bi-person-vcard"></i>
              <span class="ms-2">My account</span>
          </a>
        </li>

        <li>
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="dropdown-item text-danger" type="submit">
              <i class="bi bi-box-arrow-right"></i>
              <span class="ms-2">Logout</span>
            </button>
          </form>
        </li>

      </x-dropdown>
    </div>
  </div>
</div>
<br>
