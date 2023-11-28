<x-modal id="modalRemoveExtension" title="Remove extension" header-close>
    <div class="text-center">
        <p>¿Are you sure to remove the extension<br><b></b>?</p>
        <small class="fw-bold text-success">* All information will be kept safe</small>
    </div>
    <br>
    <form action="{{ route('jobs.extensions.detach', $job) }}" method="post">
        @csrf
        @method('delete')
        <input type="hidden" name="extension" value="">
        <div class="text-center">
            <button class="btn btn-outline-danger" type="submit">Yes, remove extension</button>
            <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>
</x-modal>
@push('scripts')
<script>
const modalRemoveExtension = {
    element: document.getElementById('modalRemoveExtension'),
    load: function (extension) {
        this.element.querySelector('p > b').textContent = extension.name
        this.element.querySelector('form > input[name="extension"]').value = extension.id
    },
    clear: function () {
        this.element.querySelector('p > b').textContent = ''
        this.element.querySelector('form > input[name="extension"]').value = null
    },
    listen: function () {
        this.element.addEventListener('hide.bs.modal', (e) => {
            modalRemoveExtension.clear()
        })
    }
}

const modalRemoveExtensionTriggers = {
    listen: function () {
        document.querySelectorAll('button[data-bs-target="#modalRemoveExtension"]').forEach((button) => {
            button.addEventListener('click', (e) => {
                modalRemoveExtension.load( 
                    JSON.parse(e.target.value)
                );
            })
        })
    }
}
modalRemoveExtensionTriggers.listen()

</script>
@endpush
