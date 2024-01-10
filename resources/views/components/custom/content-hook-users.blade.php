<p>
    <small>Created</small><br>
    <span>{{ $model->created_at }}</span><br>
    <span>{{ $model->creator ? $model->creator->name : '' }}</span>
</p>

<p>
    <small>Updated</small><br>
    <span>{{ $model->updated_at }}</span><br>
    <span>{{ $model->updater ? $model->updater->name : '' }}</span>
</p>

@if( $model->deleter )  
<p>
    <small>Deleted</small><br>
    <span>{{ $model->deleted_at ?? '' }}</span><br>
    <span>{{ $model->deleter ? $model->deleter->name : '' }}</span>
</p>
@endif
