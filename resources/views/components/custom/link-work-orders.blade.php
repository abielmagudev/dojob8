<?php

if( $attributes->has('unfinished') )
{
    $parameters = array_merge($parameters, [
        'status_rule' => 'only',
        'status_group' => App\Models\WorkOrder::getUnfinishedStatuses()->all(),
        'sort' => 'asc',
    ]);
    
    $tooltip = $attributes->get('tooltip', 'Unfinished work orders');
}
else
{
    $tooltip = $attributes->get('tooltip', 'Work orders');
}

?>

<x-tooltip title="{{ $tooltip }}">
    <a href="{{ route('work-orders.index', $parameters) }}" class="{{ $attributes->get('class', 'btn btn-primary') }}">
        {{ $slot }}
    </a>
</x-tooltip>
