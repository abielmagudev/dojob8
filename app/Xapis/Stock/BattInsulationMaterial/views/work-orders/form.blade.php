<p>
    <b>{{ $extension->name }}</b>
</p>
<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <label for="battInsMatSpaceSelect" class="form-label">Space</label>
            <select id="battInsMatSpaceSelect" class="form-select" name="battinsmat_space" required>
                @foreach($spaces_rvalues->keys() as $space)
                <option value="{{ $space }}" <?= isSelected( $space == old('battinsmat_space', $battInsMat->space) ) ?>>{{ ucfirst($space) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="battinsmat_space" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battInsMatRvalueNameSelect" class="form-label">R-Value</label>
            <select id="battInsMatRvalueNameSelect" class="form-select" name="battinsmat_rvalue_name">
                @foreach($spaces_rvalues as $space => $rvalues)
                <optgroup label="{{ ucfirst($space) }}">
                    @foreach($rvalues as $rvalue_name)
                    <option value="{{ $rvalue_name }}" <?= isSelected( $rvalue_name == old('battinsmat_rvalue_name', $battInsMat->rvalue_name) ) ?>>{{ ucfirst($rvalue_name) }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
            <x-form-feedback error="battinsmat_rvalue_name" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battInsMatSizeSelect" class="form-label">Size</label>
            <select id="battInsMatSizeSelect" class="form-select" name="battinsmat_size">
                @foreach($sizes as $size)
                <option value="{{ $size }}" <?= isSelected( $size == old('battinsmat_size', $battInsMat->size) ) ?>>{{ ucfirst($size) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="battinsmat_size" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battInsMatTypeSelect" class="form-label">Type</label>
            <select id="battInsMatTypeSelect" class="form-select" name="battinsmat_type">
                @foreach($types as $type)
                <option value="{{ $type }}" <?= isSelected( $type == old('battinsmat_type', $battInsMat->type) ) ?>>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="battinsmat_type" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <label for="battInsMatSquareFootageInput" class="form-label">Square footage</label>
            <input id="battInsMatSquareFootageInput" class="form-control" type="number" name="battinsmat_square_footage" value="{{ old('battinsmat_square_footage', $battInsMat->square_footage) }}" min="0.00" step="0.01" required>
            <x-form-feedback error="battinsmat_square_footage" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="battInsMatSquareFootageNettingInput" class="form-label form-label-optional">Square footage of Netting</label>
            <input id="battInsMatSquareFootageNettingInput" class="form-control" type="number" name="battinsmat_square_footage_netting" value="{{ old('battinsmat_square_footage_netting', $battInsMat->square_footage_netting) }}" min="0.00" step="0.01">
            <x-form-feedback error="battinsmat_square_footage_netting" />
        </div>
    </div>
</div>
