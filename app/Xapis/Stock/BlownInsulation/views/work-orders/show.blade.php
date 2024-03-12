<p>
    <b>{{ $extension->name }}</b>
</p>
<div class="row">
    <div class="col-sm">
        <x-small-title title="Area">
            <span class="text-capitalize">{{ $blownins->area }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="R-Value">
            <span class="text-capitalize">{{ $blownins->rvalue_name }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Size">
            <span class="text-capitalize">{{ $blownins->size }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Type">
            <span class="text-capitalize">{{ $blownins->type }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Square footage">
            <span class="text-capitalize">{{ $blownins->square_footage }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Square footage of Netting">
            <span class="text-capitalize">{{ $blownins->square_footage_netting }}</span>
        </x-small-title>
    </div>
</div>
<br>
