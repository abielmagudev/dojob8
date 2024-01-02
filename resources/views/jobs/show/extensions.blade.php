<x-card title="Extensions">
    <x-slot name="options">
        @if( $extensions->count() )
        <x-modal-trigger class="btn btn-primary" modal-id="modalAddExtension">
            <b>+</b>
        </x-modal-trigger>
        @endif
    </x-slot>

    @if( $job->hasExtensions() )
    <div class="mb-3">
        <x-table class="align-middle">
            @foreach($job->extensions as $extension)
            <tr>
                <td>{{ $extension->name }}</td>
                <td class="text-end">
                    <x-modal-trigger class="btn btn-outline-danger" modal-id="modalRemoveExtension" name="extension" :value="json_encode(['id' => $extension->id, 'name' => $extension->name])">
                        <b>X</b>
                    </x-modal-trigger>
                </td>
            </tr>
            @endforeach
        </x-table>
    </div>
    @endif
</x-card>
