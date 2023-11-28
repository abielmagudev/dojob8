<x-form-control-horizontal class="align-items-center">
    <x-slot name="label"></x-slot>

    {{-- Extensions of job selected or saved --}}
    <div id="extensions">
        {{-- Loading image --}}
        <div id="loading" class="mb-3 d-none">  
            <div class="spinner-border spinner-border-sm" role="status"></div>
            <span>Loading extensions...</span>   
        </div>

        {{-- Templates container --}}
        <div id="container" class="mb-3 d-none">
            <label class="form-label d-none">Extensions</label>
            <div id='templates'></div>
        </div>

        {{-- Template clone --}}
        <template id="template">
            <div class="alert alert-light"></div>
        </template>
    </div>
</x-form-control-horizontal>
