<div class="container-fluid text-bg-white py-3">
  <div class="d-flex justify-content-between align-items-center">

    {{-- Left --}}
    <div>
      <div class="d-flex align-items-center">
        <div class="me-3">
          <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebarMenu" aria-controls="offcanvasSidebarMenu">
            <i class="bi bi-list"></i>
          </button>
        </div>
        <div class="lh-1">
          <b class="d-block">{{ config('app.name') }}</b>
          <small>{{ now()->toFormattedDayDateString() }}</small>
        </div>
      </div>
    </div>

    {{-- Center --}}
    <div class="d-none d-md-inline-block">
      <form action="{{ route('clients.search') }}" method="get" autocomplete="off">
        <input class="form-control rounded-pill bg-transparent text-center" type="search" name="query" id="searchClientInput" placeholder="Search client..." style="width:320px">
      </form>
    </div>

    {{-- Right --}}
    <div class="text-end">
      <x-dropdown button="Username">
        <x-slot name="button">
          <i class="bi bi-person-circle"></i>
          <span class="d-none d-md-inline-block ms-1">Username</span>
        </x-slot>

        <li class="d-block d-md-none">
          <h6 class="dropdown-header">Username</h6>
        </li>
        <li>
          <button id="themeModeButton" class="dropdown-item" type="button" data-mode="light">
              <i class="bi bi-sun"></i>
              <span class="ms-2">Light mode</span>
          </button>
        </li>
        <li>
          <button id="buttonCollapseExpand" class="dropdown-item" type="button">
            <i class="bi bi-arrows-collapse-vertical"></i>
            <span class="ms-2">Collapse</span>
          </button>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item" href="#">
              <i class="bi bi-sliders"></i>
              <span class="ms-2">Preferences</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="#">
              <i class="bi bi-person"></i>
              <span class="ms-2">My account</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item text-danger" href="#">
              <i class="bi bi-box-arrow-right"></i>
              <span class="ms-2">Logout</span>
          </a>
        </li>
      </x-dropdown>
    </div>
  </div>
</div>
<br>

@push('scripts')
<script>
const htmlTag = document.querySelector('html')
const themeModeButton = {
  element: document.getElementById('themeModeButton'),
  listen: function () {
    
    this.element.addEventListener('click', function (evt) {
      let button = evt.target.closest('button')

      if( button.dataset.mode == 'light' )
      {
        htmlTag.dataset.bsTheme = 'light'
        button.querySelector('i').classList.replace('bi-sun', 'bi-moon')
        button.querySelector('span').textContent = 'Dark mode'
        button.dataset.mode = 'dark'
      }
      else
      {
        htmlTag.dataset.bsTheme = 'dark'
        button.querySelector('i').classList.replace('bi-moon', 'bi-sun')
        button.querySelector('span').textContent = 'Light mode'
        button.dataset.mode = 'light'
      }
    })

  }
}
themeModeButton.listen()
</script>

<script>
  const mainContainer = document.getElementById('main');
  
  document.getElementById('buttonCollapseExpand').addEventListener('click', function (evt) {
      let button = evt.target.closest('button')

      if( mainContainer.classList.contains('container') )
      {
        mainContainer.classList.replace('container', 'container-fluid')
        button.querySelector('i').classList.replace('bi-arrows-expand-vertical', 'bi-arrows-collapse-vertical')
        button.querySelector('span').textContent = 'Collapse'
      } 
      else
      {
        mainContainer.classList.replace('container-fluid', 'container')
        button.querySelector('i').classList.replace('bi-arrows-collapse-vertical', 'bi-arrows-expand-vertical')
        button.querySelector('span').textContent = 'Expand'
      }
  })
  </script>
@endpush
