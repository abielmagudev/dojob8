<h6 class="text-secondary">Participants</h6>
<div class="alert border rounded mb-3">
    <div class="row">
        <div class="col-sm">
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
        </div>

        <div class="col-sm">
            <x-small-title title="Crew">
                @includeWhen($work_order->hasCrew(), 'crews.__.flag', ['crew' => $work_order->crew])
                <br>
                <small>{{ $work_order->crew->description ?? '' }}</small>
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Crew members">
                {!! $work_order->members->pluck('full_name')->implode('<br>') !!}
            </x-small-title>
        </div>
    </div>
</div>
