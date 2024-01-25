<?php $tabs = [
    'information' => [
        'disabled' => false,
        'title' => 'Information',
    ],
    'inspections' => [
        'disabled' => false,
        'title' => 'Inspections',
    ],
    'reworks' => [
        'disabled' => $work_order->isBound(),
        'title' => 'Reworks',
    ],
    'warranties' => [
        'disabled' => $work_order->isBound(),
        'title' => 'Warranties',
    ],
    'timeline' => [
        'disabled' => false,
        'title' => 'Timeline',
    ],
    'media' => [
        'disabled' => false,
        'title' => 'Photos & files',
    ],
    'comments' => [
        'disabled' => false,
        'title' => 'Comments',
    ],
    'history' => [
        'disabled' => false,
        'title' => 'History',
    ],
]; ?>

<div class="overflow-x-scroll pb-2 mb-3">
    <ul class="nav nav-pills nav-fill" style="min-width:1024px">
        @foreach($tabs as $tab => $settings)      
        <li class="nav-item border-0">
            <a 
                class="nav-link border-0 {{ $show == $tab ? 'active fw-bold' : '' }} {{ $settings['disabled'] ? 'disabled' : '' }}" 
                href="{{ route('work-orders.show', [$work_order, 'tab' => $tab]) }}"
            >{{ $settings['title'] }}</a>
        </li>
        @endforeach
    </ul>
</div>
