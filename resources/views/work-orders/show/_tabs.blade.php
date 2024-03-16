<?php $tabs = [
    'information' => [
        'display' => true,
        'enabled' => true,
        'title' => 'Information',
    ],
    'inspections' => [
        'display' => $work_order->isStandard(),
        'enabled' => $work_order->job->requiresSuccessInspections(), // $work_order->qualifiesForInspection()
        'title' => 'Inspections',
    ],
    'reworks' => [
        'display' => $work_order->isStandard(),
        'enabled' => $work_order->qualifiesForRectification(),
        'title' => 'Reworks',
    ],
    'warranties' => [
        'display' => $work_order->isStandard(),
        'enabled' => $work_order->qualifiesForRectification(),
        'title' => 'Warranties',
    ],
    'media' => [
        'display' => true,
        'enabled' => true,
        'title' => 'Photos & Documents',
    ],
    'comments' => [
        'display' => auth()->user()->can('see-comments'),
        'enabled' => auth()->user()->can('see-comments'),
        'title' => 'Comments',
    ],
    'history' => [
        'display' => auth()->user()->can('see-history'),
        'enabled' => auth()->user()->can('see-history'),
        'title' => 'History',
    ],
]; ?>

<div class="overflow-x-scroll pb-2 mb-3">
    <ul class="nav nav-pills nav-fill" style="min-width:1024px">
        @foreach($tabs as $tab => $settings)      
        @if( $settings['display'] )         
        <li class="nav-item border-0">
            <a 
                class="nav-link border-0 {{ $template == $tab ? 'active fw-bold' : '' }} {{ $settings['enabled'] ? '' : 'disabled' }}" 
                href="{{ route('work-orders.show', [$work_order, 'tab' => $tab]) }}"
            >{{ $settings['title'] }}</a>
        </li>
        @endif
        @endforeach
    </ul>
</div>
