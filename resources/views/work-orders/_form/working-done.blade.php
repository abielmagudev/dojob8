@if( $work_order->isStatus('new') )
<button class="btn btn-warning" name="status" value="working">
    Start to
    <b>work</b>
</button>
@endif

@if( $work_order->isStatus('working') )
<button class="btn btn-success" name="status" value="done">
    It's
    <b>done</b>
</button>
@endif
