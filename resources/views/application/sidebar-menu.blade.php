<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebarMenu" aria-labelledby="offcanvasSidebarMenuLabel">
    <div class="offcanvas-header">
        <div>
            <h5 class="offcanvas-title" id="offcanvasSidebarMenuLabel">Dojob</h5>
            <small class="text-secondary">{{ now()->toFormattedDayDateString() }}</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <x-nav class="nav-pills" vertical>
            @include('application.menus.admin')
        </x-nav>
    </div>
</div>
