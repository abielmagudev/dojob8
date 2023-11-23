<x-custom.p-label label="Created">
    <span class="d-block">{{ $model->created_at }}</span>
    <span class="d-block">{{ $model->creator->name }}</span>
</x-custom.p-label>

<x-custom.p-label label="Updated">
    <span class="d-block">{{ $model->updated_at }}</span>
    <span class="d-block">{{ $model->updater->name }}</span>
</x-custom.p-label>
