<div class="alert border rounded">
    <h6 class="text-secondary">Extensions</h6>
    <div id="extensions">
        {{-- Loading image --}}
        <div id="loading" class="d-none mt-3">  
            <div class="spinner-border spinner-border-sm" role="status"></div>
            <span>Loading extensions...</span>   
        </div>

        {{-- Templates container --}}
        <div id="container" class="d-none mt-3">
            <label class="form-label d-none">Extensions</label>
            <div id='templates'></div>
        </div>

        {{-- Template clone --}}
        <template id="template">
            <div class=""></div>
        </template>
    </div>

    @push('scripts') 
    @include('work-orders.scripts.extensionsLoader')
    <script>
        extensionsLoader.get("<?= route('work-orders.ajax.show', $work_order) ?>")
    </script>
    @endpush
</div>
