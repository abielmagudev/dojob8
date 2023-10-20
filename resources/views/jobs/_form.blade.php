@csrf
<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $job->name) }}" required>
    <x-error name="name" />
</div>
<div class="mb-3">
    <label for="textareaDescription" class="form-label">Description <small class="text-body-secondary">(Optional)</small></label>
    <textarea id="textareaDescription" rows="3" class="form-control" name="description">{{ old('description', $job->description) }}</textarea>
    <x-error name="description" />
</div>
<div class="mb-3">
    <label for="inputSuccessfulInspections" class="form-label">Successful inspections</label>
    <input type="number" step="1" min="0" class="form-control" id="inputSuccessfulInspections" name="successful_inspections" value="{{ old('successful_inspections', ($job->successful_inspections ?? 0)) }}" required>
    <x-error name="successful_inspections" />
</div>
<div class="mb-3">
    <label class="form-label">Extensions</label>
    <div class="table-responsive border rounded" style="height:144px">
        <table class="table table-hover">
            <tbody>
                @foreach($extensions as $extension)
                <?php $element_id = "extension{$extension->id }" ?>
                <tr>
                    <td class="pe-0" style="width:1%">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="{{ $element_id }}" name="extensions[]" value="{{ $extension->id }}" {{-- isChecked( $job->extensions->contains('id', old('extensions', $extension->id)) ) --}}>
                        </div>
                    </td>
                    <td>
                        <label class="form-check-label d-block" for="{{ $element_id }}">
                            {{ $extension->name }}
                            <small class="d-block text-muted">{{ $extension->description }}</small>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-error name="extensions" />
    <x-error name="extensions.*" />
</div>
