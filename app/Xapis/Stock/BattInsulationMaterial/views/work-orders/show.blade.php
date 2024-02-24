<p>
    <b>{{ $extension->name }}</b>
</p>
<div class="row">
    <div class="col-sm">
        <x-small-title title="Space">
            <span class="text-capitalize">{{ $battInsMat->space }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="R-Value">
            <span class="text-capitalize">{{ $battInsMat->rvalue_name }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Size">
            <span class="text-capitalize">{{ $battInsMat->size }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Type">
            <span class="text-capitalize">{{ $battInsMat->type }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Square footage">
            <span class="text-capitalize">{{ $battInsMat->square_footage }}</span>
        </x-small-title>
    </div>
    <div class="col-sm">
        <x-small-title title="Square footage of Netting">
            <span class="text-capitalize">{{ $battInsMat->square_footage_netting }}</span>
        </x-small-title>
    </div>
</div>
