<?php $tabs = [
    'information' => [
        'display' => true,
        'enabled' => true,
        'title' => 'Information',
    ],
    'inspections' => [
        'display' => true,
        'enabled' => $work_order->job->requiresApprovedInspections(),
        'title' => 'Inspections',
    ],
    'reworks' => [
        'display' => $work_order->isStandard(),
        'enabled' => $work_order->isStandard(),
        'title' => 'Reworks',
    ],
    'warranties' => [
        'display' => $work_order->isStandard(),
        'enabled' => $work_order->isStandard(),
        'title' => 'Warranties',
    ],
    'timeline' => [
        'display' => true,
        'enabled' => true,
        'title' => 'Timeline',
    ],
    'media' => [
        'display' => true,
        'enabled' => true,
        'title' => 'Photos & files',
    ],
    'comments' => [
        'display' => true,
        'enabled' => true,
        'title' => 'Comments',
    ],
    'history' => [
        'display' => true,
        'enabled' => true,
        'title' => 'History',
    ],
]; ?>

<div class="overflow-x-scroll pb-2 mb-3">
    <ul class="nav nav-pills nav-fill" style="min-width:1024px">
        @foreach($tabs as $tab => $settings)      
        @if( $settings['display'] )         
        <li class="nav-item border-0">
            <a 
                class="nav-link border-0 {{ $show == $tab ? 'active fw-bold' : '' }} {{ $settings['enabled'] ? '' : 'disabled' }}" 
                href="{{ route('work-orders.show', [$work_order, 'tab' => $tab]) }}"
            >{{ $settings['title'] }}</a>
        </li>
        @endif
        @endforeach
    </ul>
</div>
