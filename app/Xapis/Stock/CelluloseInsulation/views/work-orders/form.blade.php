<p>
    <b>{{ $extension->name }}</b>
</p>

<div class="row">

    <div class="col-sm">
        <div class="mb-3">
            <label for="celluloseinsAreaSelect" class="form-label">Area</label>
            <select id="celluloseinsAreaSelect" class="form-select" name="celluloseins_area" required>
                @foreach($areas_rvalues->keys() as $area)
                <option value="{{ $area }}" <?= isSelected( $area == old('celluloseins_area', $celluloseins->area) ) ?>>{{ ucfirst($area) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="celluloseins_area" />
        </div>
    </div>

    <div class="col-sm">
        <div class="mb-3">
            <label for="celluloseinsRvalueNameSelect" class="form-label">R-Value</label>
            <select id="celluloseinsRvalueNameSelect" class="form-select" name="celluloseins_rvalue_name" required>
                @foreach($areas_rvalues as $area => $rvalues)
                <optgroup label="{{ ucfirst($area) }}">
                    @foreach($rvalues as $rvalue_name => $rvalue_score)
                    <option value="{{ $rvalue_name }}" data-score="{{ $rvalue_score }}" <?= isSelected( $rvalue_name == old('celluloseins_rvalue_name', $celluloseins->rvalue_name) ) ?>>{{ ucfirst($rvalue_name) }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
            <x-form-feedback error="celluloseins_rvalue_name" />
        </div>
    </div>

    <div class="col-sm">
        <div class="mb-3">
            <label for="celluloseinsSquareFootageInput" class="form-label">Square footage</label>
            <input id="celluloseinsSquareFootageInput" class="form-control" type="number" name="celluloseins_square_footage" value="{{ old('celluloseins_square_footage', $celluloseins->square_footage) }}" min="0.00" step="0.01" required>
            <x-form-feedback error="celluloseins_square_footage" />
        </div>
    </div>

    <div class="col-sm">
        <div class="mb-3">
            <label for="celluloseinsBagsInput" class="form-label">Bags</label>
            <input id="celluloseinsBagsInput" class="form-control" type="number" name="celluloseins_bags" value="{{ old('celluloseins_bags', ($celluloseins->bags ?? 0)) }}" min="0" step="1" readonly>
            <x-form-feedback error="celluloseins_bags" />
        </div>
    </div>

</div>

<script src="{{ asset('storage/xapis/celluloseins.js') }}" fake></script>
