<p>
    <b>{{ $extension->name }}</b>
</p>
<div class="row">
    <div class="col-sm">
        <x-small-title title="Area">
            <span class="text-capitalize">{{ $battins->area }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="R-Value">
            <span class="text-capitalize">{{ $battins->rvalue_name }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Size">
            <span class="text-capitalize">{{ $battins->size }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Type">
            <span class="text-capitalize">{{ $battins->type }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Square footage">
            <span class="text-capitalize">{{ $battins->square_footage }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Square footage of Netting">
            <span class="text-capitalize">{{ $battins->square_footage_netting }}</span>
        </x-small-title>
    </div>
</div>
<br>
