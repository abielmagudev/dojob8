<x-card>
    @slot('options')
    <a href="{{ route('work-orders.edit', $work_order) }}" class="btn btn-warning ms-3">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot

    <x-small-title title="Job">
        <span class="d-block">{{ $work_order->job->name }}</span>
        <small>{{ $work_order->job->description }}</small>
    </x-small-title>

    <x-small-title title="Successful inspections required">
        {{ $work_order->job->requiresSuccessfulInspections() ? $work_order->job->successful_inspections_required : 0 }}
    </x-small-title>

    <x-small-title title="Extensions">
        {{ $work_order->job->hasExtensions() ? 'Yes' : 'No' }}
    </x-small-title>

    @if( $work_order->job->hasExtensions() )
        @foreach($work_order->job->extensions as $extension)
        <div>{{ $extension->name }}</div>
        @endforeach
    @endif
    
    <x-small-title title="Notes">
        {{ $work_order->notes }}
    </x-small-title>

    <x-small-title title="Contractor">
        @if( $work_order->hasContractor() )
        @include('contractors.__.address', [
            'contractor' => $work_order->contractor,
        ])
        <x-custom.information-contact-channels :channels="$work_order->contractor->contact_data->filter()"/>
        
        @else
        <span>None</span>

        @endif
    </x-small-title>
    
    <x-small-title title="Crew">
        @include('crews.__.flag', ['crew' => $work_order->crew])
    </x-small-title>

    <x-small-title title="Workers">
        {!! $work_order->members->map(function($member){ return $member->full_name; })->implode('<br>') !!}
    </x-small-title>

    <x-custom.information-hook-users :model="$work_order" />
</x-card>
