<x-media.card-visualizer 
    :media="$media" 
    action-upload="{{ route('media.store', ['work-orders', $work_order->id]) }}" 
    action-delete="{{ route('media.destroy', ['work-orders', $work_order->id]) }}"
/>
