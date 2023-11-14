<div class="bg-primary-gradient-custom text-white" style="padding:1.75rem 0">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="d-inline-block d-lg-none align-middle me-1">
                    <button class="btn btn-outline-primary border-0 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebarMenu" aria-controls="offcanvasSidebarMenu">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <div class="d-inline-block align-middle">
                    <h4 class="m-0">Dojob</h4>
                    <small class="text-white d-none d-lg-block">{{ now()->toFormattedDayDateString() }}</small>
                </div>
            </div>
            <div>
                <x-dropdown button-class="btn-outline-primary border-0 text-white " menu-class="dropdown-menu-end" no-caret>
                    <x-slot name="button">
                        <span class="align-middle me-1">username</span>
                        <i class="bi bi-person-circle align-middle" style="font-size:1.2rem"></i>
                    </x-slot>

                    <li>
                        <h6 class="dropdown-header">Company name</h6>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person"></i>
                            <span class="ms-1">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-sliders"></i>
                            <span class="ms-1">Preferences</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="ms-1">Logout</span>
                        </a>
                    </li>
                </x-dropdown>
            </div>
        </div>
    </div>
</div>
