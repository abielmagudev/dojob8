<x-form-field-horizontal for="typeSelect" label="Type">
    <select id="typeSelect" class="form-select {{ bsInputInvalid( $errors->has('type') ) }}" name="type" required>

        @foreach($all_types as $type)
        <option value="{{ $type }}" {{ isSelected( $type == old('type', ($request->get('type') ?? $work_order->type)) ) }}>
            {{ title($type) }}
        </option>
        @endforeach
        
    </select>
    <x-form-feedback error="type" />

    @foreach($non_default_types as $type)
    <div class="{{ $work_order->isType($type) || old('type', $request->get('type')) == $type ? '' : 'd-none' }}">

        <select 
            id="{{ $type }}Select" 
            name="{{ $type }}" 
            class="form-select mt-3 {{ bsInputInvalid( $errors->has($type) ) }}" 
            {{ isDisabled( ! $work_order->isType($type) && old('type', $request->get('type')) <> $type ) }} 
            required
        >

            <option disabled selected label="{{ $client->hasWorkOrdersForRework() ? "Choose a work order for {$type}..." : "There are no work orders with qualified status for {$type}" }}."></option>

            <?php $work_orders_to_bind = $type == 'rework' ? $client->work_orders_for_rework : $client->work_orders_for_warranty ?> 

            @foreach($work_orders_to_bind->except( $work_order->id ?? 0 ) as $wo)
            <option value="{{ $wo->id }}" {{ isSelected( $wo->id == old('bind', $work_order->bound_id ?? $request->get('bind')) ) }}>
                {{ $wo->id }} - {{ $wo->job->name }} ({{ ucfirst($wo->status) }})
            </option>
            @endforeach

            @if( $work_order->isType($type) &&! $work_orders_to_bind->contains($work_order->bound_id) )
            <option disabled></option>
            <option value="{{ $work_order->bound_id }}" {{ isSelected( $work_order->bound_id == old($type ?? $request->get('bind')) ) }} selected>
                {{ $work_order->bound->id }} - {{ $work_order->bound->job->name }} ({{ ucfirst($work_order->bound->status) }})
                @if(! $work_order->bound->qualifiesToBind() )
                ...currently does not qualify for rework or warranty!  
                @endif
            </option>
            @endif

        </select>
    </div>
    <x-form-feedback error="{{ $type }}" />
    @endforeach
</x-form-field-horizontal>

@push('scripts')
<script>
const typeSelectComponent = {
    typeSelect: document.getElementById('typeSelect'),
    nonDefaultTypes:  Object.values(<?= $non_default_types->toJson() ?>),
    listen: function () {
        this.typeSelect.addEventListener('change', function (evt) {
            typeSelectComponent.nonDefaultTypes.forEach(function (type) {
                let bindSelectElement = document.getElementById(type + 'Select');
                let bool = type != evt.target.value;
                bindSelectElement.disabled = bool;
                bindSelectElement.selectedIndex = 0;
                bindSelectElement.closest('div').classList.toggle('d-none', bool);
            })
        })
    }
}
typeSelectComponent.listen();
</script>
@endpush
