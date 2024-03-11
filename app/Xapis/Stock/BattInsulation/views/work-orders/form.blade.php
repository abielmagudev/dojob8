<p>
    <b>{{ $extension->name }}</b>
</p>
<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <label for="battinsSpaceSelect" class="form-label">Space</label>
            <select id="battinsSpaceSelect" class="form-select" name="battins_space" required>
                @foreach($rvalues_by_space->keys() as $space)
                <option value="{{ $space }}" <?= isSelected( $space == old('battins_space', $battins->space) ) ?>>{{ ucfirst($space) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="battins_space" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battinsRvalueNameSelect" class="form-label">R-Value</label>
            <select id="battinsRvalueNameSelect" class="form-select" name="battins_rvalue_name">
                @foreach($rvalues_by_space as $space => $rvalues)
                <optgroup label="{{ ucfirst($space) }}">
                    @foreach($rvalues as $rvalue_name)
                    <option value="{{ $rvalue_name }}" <?= isSelected( $rvalue_name == old('battins_rvalue_name', $battins->rvalue_name) ) ?>>{{ ucfirst($rvalue_name) }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
            <x-form-feedback error="battins_rvalue_name" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battinsSizeSelect" class="form-label">Size</label>
            <select id="battinsSizeSelect" class="form-select" name="battins_size">
                @foreach($sizes as $size)
                <option value="{{ $size }}" <?= isSelected( $size == old('battins_size', $battins->size) ) ?>>{{ ucfirst($size) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="battins_size" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battinsTypeSelect" class="form-label">Type</label>
            <select id="battinsTypeSelect" class="form-select" name="battins_type">
                @foreach($types as $type)
                <option value="{{ $type }}" <?= isSelected( $type == old('battins_type', $battins->type) ) ?>>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="battins_type" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <label for="battinsSquareFootageInput" class="form-label">Square footage</label>
            <input id="battinsSquareFootageInput" class="form-control" type="number" name="battins_square_footage" value="{{ old('battins_square_footage', $battins->square_footage) }}" min="0.00" step="0.01" required>
            <x-form-feedback error="battins_square_footage" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battinsSquareFootageNettingInput" class="form-label form-label-optional">Square footage of Netting</label>
            <input id="battinsSquareFootageNettingInput" class="form-control" type="number" name="battins_square_footage_netting" value="{{ old('battins_square_footage_netting', $battins->square_footage_netting) }}" min="0.00" step="0.01">
            <x-form-feedback error="battins_square_footage_netting" />
        </div>
    </div>
</div>
