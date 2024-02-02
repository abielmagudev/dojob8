@if( $model->creator )
<p>
    <small>Created</small><br>
    <span>{{ $model->created_at ?? '' }}</span><br>
    <span>{{ $model->creator ? $model->creator->name : '' }}</span>
</p> 
@endif

@if( $model->updater )  
<p>
    <small>Updated</small><br>
    <span>{{ $model->updated_at ?? '' }}</span><br>
    <span>{{ $model->updater ? $model->updater->name : '' }}</span>
</p>
@endif

@if( $model->deleter )  
<p>
    <small>Deleted</small><br>
    <span>{{ $model->deleted_at ?? '' }}</span><br>
    <span>{{ $model->deleter ? $model->deleter->name : '' }}</span>
</p>
@endif
