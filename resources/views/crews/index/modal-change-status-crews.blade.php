<x-modal id="changeStatusCrewsModal" title="Change status crews" subtitle="Active and inactive" header-close>
    <form action="{{ route('crews.update.status') }}" method="post" autocomplete="off" id="updateStatusCrewsForm">
        @csrf
        @method('patch')

        <div class="form-control p-0 overflow-y-scroll" style="max-height:50vh">
            <div class="list-group list-group-flush rounded overflow-hidden">
                @foreach($crews as $crew)
                <?php $switch_id = sprintf('crew%sSwitch', $crew->id) ?>
                <div class="list-group-item list-group-item-action ">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <label for="{{ $switch_id }}" class="form-label">
                                @include('crews.__.flag')
                            </label>
                        </div>
                        <div>
                            <div class="form-check form-switch">
                                <input id="{{ $switch_id }}" class="form-check-input" type="checkbox" role="switch" name="crews[]" value="{{ $crew->id }}" {{ isChecked( $crew->isActive() ) }}>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <x-form-feedback error="crews" />
        <x-form-feedback error="crews.*" />

    </form>
    <div class="text-end mb-3">
        <small class="text-secondary">Scroll up or down</small>
    </div>

    <div class="alert alert-warning small mb-3">
        <i class="bi bi-exclamation-triangle"></i>
        <span>If you deactivate one, it cannot be used in new work orders and crew members will be removed.</span>
    </div>

    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-warning" type="submit" form="updateStatusCrewsForm">Update crews</button>
    @endslot
</x-modal>
