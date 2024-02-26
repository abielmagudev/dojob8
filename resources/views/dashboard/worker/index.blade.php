@extends('application')
@section('content')

@section('header')
<x-page-title>Dashboard (Worker)</x-page-title>
@endsection

@section('content')
<div class="row">
    <!-- Work Orders -->
    <div class="col-sm mb-3">
        <x-box class="text-center">
            <p class="text-uppercase">Work Orders</p>

            @if( $work_orders->count() )
            <a href="<?= route('work-orders.index', ['scheduled' => $today]) ?>" class="display-1 text-white text-decoration-none">
                {{ $work_orders->count() }}
            </a>
            
            @else
            <span class="display-1">0</span>
            
            @endif

        </x-box>
    </div>

    <!-- Inspections -->
    <div class="col-sm mb-3">
        <x-box  class="text-center">
            <p class="text-uppercase">Inspections</p>

            @if( $inspections->count() )
            <a href="<?= route('inspections.index', ['scheduled' => $today]) ?>" class="display-1 text-white text-decoration-none">
                {{ $inspections->count() }}
            </a>
            
            @else
            <span class="display-1">0</span>

            @endif

        </x-box>

        </div>
    </div>
</div>
@endsection

@endsection
