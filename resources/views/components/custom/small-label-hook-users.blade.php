<x-small-label label="Created">
    <span class="d-block">{{ $model->created_at }}</span>
    <span class="d-block">{{ $model->creator ? $model->creator->name : '' }}</span>
</x-small-label>

<x-small-label label="Updated">
    <span class="d-block">{{ $model->updated_at }}</span>
    <span class="d-block">{{ $model->updater ? $model->updater->name : '' }}</span>
</x-small-label>

@if( $attributes->has('show-deleted') )  
<x-small-label label="Deleted">
    <span class="d-block">{{ $model->deleted_at ?? '' }}</span>
    <span class="d-block">{{ $model->deleter ? $model->deleter->name : '' }}</span>
</x-small-label>
@endif
