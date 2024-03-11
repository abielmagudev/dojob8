<p>
    <b>{{ $extension->name }}</b>
</p>
<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <label for="blowninsSpaceSelect" class="form-label">Space</label>
            <select id="blowninsSpaceSelect" class="form-select" name="blownins_space" required>
                @foreach($spaces as $space)
                <option value="{{ $space }}" <?= isSelected( $space == old('blownins_space', $blownins->space) ) ?>>{{ ucfirst($space) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="blownins_space" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="blowninsRvalueNameSelect" class="form-label">R-Value</label>
            <select id="blowninsRvalueNameSelect" class="form-select" name="blownins_rvalue_name" required>
                @foreach($rvalues as $space => $rvalues)
                <optgroup label="{{ ucfirst($space) }}">
                    @foreach($rvalues as $rvalue_name => $rvalue_score)
                    <option value="{{ $rvalue_name }}" data-score="{{ $rvalue_score }}" <?= isSelected( $rvalue_name == old('blownins_rvalue_name', $blownins->rvalue_name) ) ?>>{{ ucfirst($rvalue_name) }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
            <x-form-feedback error="blownins_rvalue_name" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="blowninsSquareFootageInput" class="form-label">Square footage</label>
            <input id="blowninsSquareFootageInput" class="form-control" type="number" name="blownins_square_footage" value="{{ old('blownins_square_footage', $blownins->square_footage) }}" min="0.00" step="0.01" required>
            <x-form-feedback error="blownins_square_footage" />
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="blowninsBagsInput" class="form-label">Bags</label>
            <input id="blowninsBagsInput" class="form-control" type="number" name="blownins_bags" value="{{ old('blownins_bags', ($blownins->bags ?? 0)) }}" min="0" step="1" readonly>
            <x-form-feedback error="blownins_bags" />
        </div>
    </div>
</div>

<script src="{{ asset('storage/xapis/blownins.js') }}" fake></script>
