<x-modal id="modalFocused" dialog-class="modal-xl modal-dialog-scrollable modal-dialog-centered" body-class="text-center" footer-class="justify-content-between" header-close>

    <x-slot name="footer">
        <div>
            <form action="{{ route('media.destroy', 0) }}" method="post">
                @method('delete')
                @csrf
                <input type="hidden" name="media">
                <button class="btn btn-outline-danger border-0 btn-delete">
                    <i class="bi bi-trash"></i>
                    <span>Delete</span>
                </button>
            </form>
        </div>
        <div>
            <x-modal-button-close>Close</x-modal-button-close>
            <a class="btn btn-primary btn-download" target="_blank" download>
                <i class="bi bi-cloud-download"></i>
                <span>Download</span>
            </a>
        </div>
    </x-slot>
</x-modal>

<script>
const modalFocused = {
    element: document.getElementById('modalFocused'),
    body: function () {
        return this.element.querySelector('.modal-body');
    },
    footer: function () {
        return this.element.querySelector('.modal-footer');
    },
    buildClone: function (thumbnail) {
        let cloned = thumbnail.cloneNode(true);

        Object.keys(cloned.dataset).forEach(function(key) {
            delete cloned.dataset[key];
        });

        cloned.removeAttribute('role');
        cloned.className = 'img-fluid';
        cloned.src = 'https://picsum.photos/1024/720' // Testing

        return cloned;
    },
    listen: function () {
        this.element.addEventListener('show.bs.modal', function (event) {
            let cloned = modalFocused.buildClone( event.relatedTarget ); // event.relatedTarget: Elemento que activó el modal (miniatura)
            modalFocused.body().appendChild(cloned)
            modalFocused.footer().querySelector('form > input[name="media"]').value = cloned.src
            modalFocused.footer().querySelector('a.btn-download').href = cloned.src
        });

        this.element.addEventListener('hidden.bs.modal', function (event) {
            while( modalFocused.body().firstChild ) {
                modalFocused.body().removeChild( modalFocused.body().firstChild );
            }
            modalFocused.footer().querySelector('form > input[name="media"]').value = ''
            modalFocused.footer().querySelector('a.btn-download').href = ""
        })
    }
};

document.addEventListener('DOMContentLoaded', function () {
    modalFocused.listen()
});
</script>
