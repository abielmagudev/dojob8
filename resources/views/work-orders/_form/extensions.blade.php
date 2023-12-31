<x-form-control-horizontal class="align-items-center mb-0">
    <x-slot name="label"></x-slot>

    {{-- Extensions of job selected or saved --}}
    <div id="extensions">
        {{-- Loading image --}}
        <div id="loading" class="d-none">  
            <div class="spinner-border spinner-border-sm" role="status"></div>
            <span>Loading extensions...</span>   
        </div>

        {{-- Templates container --}}
        <div id="container" class="d-none">
            <label class="form-label d-none">Extensions</label>
            <div id='templates'></div>
        </div>

        {{-- Template clone --}}
        <template id="template">
            <div class="alert alert-light"></div>
        </template>
    </div>
</x-form-control-horizontal>
