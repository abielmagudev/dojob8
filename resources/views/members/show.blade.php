@extends('application')
@section('header')
<x-breadcrumb :items="[
    'Members' => route('members.index'),
    'Member'
]" />
<x-page-title subtitle="{{ $member->position ?? '' }}">
    {{ $member->full_name }}
    @if( $member->isHappyBirthday() )
    <i class="bi bi-cake2"></i>
    @endif
</x-page-title>
@endsection

@section('content')


<div class="row">

    <div class="col-sm">
        <x-card>
            <x-slot name="custom_title">
                <x-custom.indicator-available-status :toggle="$member->isAvailable()" />
            </x-slot>

            <x-slot name="options">
                <a href="{{ route('members.edit', $member) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
        
            @if( $member->contact_data->filter()->count() )      
            <x-small-title title="Contact">
                <x-custom.information-contact-channels :channels="$member->contact_data->filter()" />
            </x-small-title>
            @endif
        
            <x-small-title title="Notes">
                <em>{{ $member->notes }}</em>
            </x-small-title>
            
            <x-custom.information-hook-users :model="$member" />
        </x-card>
    </div>

    <div class="col-sm">
        <x-card title="Crews">
        @if( $member->isCrewMember() )
            @if( $member->hasCrews() )
            <x-table>
                <tbody>
                    @foreach($member->crews->load('incomplete_work_orders') as $crew)
                    <tr>
                        <td>
                            @include('crews.__.flag')
                        </td>
                        <td class="text-end">
                            @includeWhen($crew->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
                                'parameters' => ['crew' => $crew->id],
                                'counter' => $crew->incomplete_work_orders_count
                            ])
                            <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </x-table>
            @endif
        @else
            <p class="text-center">
                <em>Cannot belong to a crew</em>
            </p>

        @endif
        </x-card>
    </div>

</div>
@endsection
