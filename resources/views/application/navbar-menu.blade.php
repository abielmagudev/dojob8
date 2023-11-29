<div class="bg-white p-3 d-none d-lg-block">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <x-nav class="nav-pills">
                    @include('application.menus.admin')
                </x-nav>
            </div>
            <div>
                <button id="buttonExpand" type="button" class="btn btn-outline-primary">
                    <i class="bi bi-arrows-expand-vertical"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const mainContainer = document.getElementById('main-container');

document.getElementById('buttonExpand').addEventListener('click', function (evt) {
    if( mainContainer.classList.contains('container') ) {
        this.querySelector('i').classList.replace('bi-arrows-expand-vertical', 'bi-arrows-collapse-vertical')
        mainContainer.classList.replace('container', 'container-fluid')
    } else {
        this.querySelector('i').classList.replace('bi-arrows-collapse-vertical', 'bi-arrows-expand-vertical')
        mainContainer.classList.replace('container-fluid', 'container')
    }
})
</script>
@endpush