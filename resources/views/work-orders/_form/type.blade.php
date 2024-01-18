<x-form-field-horizontal label="Type">
    <select id="typeSelect" class="form-select" name="type" required>

        @foreach(\App\Models\WorkOrder::getAllTypes() as $type)
        <option value="{{ $type }}">{{ title($type) }}</option>
        @endforeach
        
    </select>
    <x-error name="type" />

    @include('work-orders._form.rework')
    @include('work-orders._form.warranty')
</x-form-field-horizontal>

@push('scripts')
<script>
const typeSelect = {
    element: document.getElementById('typeSelect'),
    values:  Object.values(<?= \App\Models\WorkOrder::getTypesNonDefault()->toJson() ?>),
    listen: function () {
        
        this.element.addEventListener('change', function (evt) {
            let selected = this.value;

            typeSelect.values.forEach(function(value) {
                let bool = value != selected;
                let select_input_id = value + 'Select';
                let select_input = document.getElementById(select_input_id)

                select_input.closest('div').classList.toggle('d-none', bool)
                select_input.disabled = bool
            })
        })
    }
}
typeSelect.listen()
</script>
@endpush