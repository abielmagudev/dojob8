<x-card class="h-100">
    <x-slot name="custom_title">
        <x-custom.indicator-active-status :toggle="$contractor->isActive()" />
    </x-slot>

    <x-slot name="options">
        @if( $contractor->hasWorkOrdersWithIncompleteStatus() )                  
        @include('work-orders.__.button-counter-incomplete', [
            'class' => 'btn btn-outline-warning',
            'counter' => $contractor->onlyIncompleteWorkOrders()->count(),
            'parameters' => ['contractor' => $contractor->id],
        ])
        @endif

        @include('work-orders.__.button-counter-all', [
            'class' => 'btn btn-outline-primary',
            'counter' => $contractor->work_orders->count(),
            'parameters' => ['contractor' => $contractor->id],
        ])

        <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <x-small-title title="Address">
        @include('contractors.__.address')
    </x-small-title>

    <x-small-title title="Contact">
        <x-custom.information-contact-channels :channels="$contractor->contact_data->filter()" />
    </x-small-title>

    <x-small-title title="Notes">
        {{ $contractor->notes }}
    </x-small-title>

    <x-custom.information-hook-users :model="$contractor" />
</x-card>
