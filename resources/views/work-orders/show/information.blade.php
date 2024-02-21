<x-card>
    @slot('options')
    <a href="{{ route('work-orders.edit', $work_order) }}" class="btn btn-warning ms-3">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot

    <div class="row">

        <!-- Work -->
        <div class="col-sm">
            <h6 class="text-secondary">Details</h6>

            <x-small-title title="Job">
                <h4>{{ $work_order->job->name }}</h4>
                <small>{{ $work_order->job->description }}</small>
            </x-small-title>

            @if( false )       
            <x-small-title title="Approved inspections required">
                {{ $work_order->job->requiresApprovedInspections() ? $work_order->job->approved_inspections_required_count : 0 }}
            </x-small-title>
            @endif

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
        </div>

        <!-- Timeline -->
        <div class="col-sm">
            <h6 class="text-secondary">Timeline</h6>

            <x-small-title title="Schedule">
                {{ $work_order->scheduled_date_human }}
            </x-small-title>

            <x-small-title title="Working at">
                {{ $work_order->working_at }}
            </x-small-title>

            <x-small-title title="Done at">
                {{ $work_order->done_at }}
            </x-small-title>

            <x-small-title title="Completed at">
                {{ $work_order->completed_date_human }}
            </x-small-title>

            <x-custom.information-hook-users :model="$work_order" />
        </div>

        <!-- Involed -->
        <div class="col-sm">
            <h6 class="text-secondary">Involed</h6>

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
        </div>
    </div>

</x-card>
