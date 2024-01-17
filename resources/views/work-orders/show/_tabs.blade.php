<?php $tabs = [
    'summary' => 'Summary',
    'inspections' => 'Inspections',
    'participants' => 'Participants',
    'timeline' => 'Timeline',
    'media' => 'Photos & files',
    'comments' => 'Comments',
    'history' => 'History',
]; ?>

<ul class="nav nav-pills">
    @foreach($tabs as $tab => $title)      
    <li class="nav-item border-0">
        <a class="nav-link border-0 {{ $show == $tab ? 'active fw-bold' : '' }}" href="{{ route('work-orders.show', [$work_order, 'tab' => $tab]) }}">{{ $title }}</a>
    </li>
    @endforeach
</ul>
<br>
