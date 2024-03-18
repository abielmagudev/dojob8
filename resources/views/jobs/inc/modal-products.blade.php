<x-modal-trigger modal-id="jobProductsModal">
    <i class="bi bi-plus-lg"></i>
</x-modal-trigger>

<x-modal id="jobProductsModal" title="Add or remove products" dialog-class="modal-dialog-scrollable">
    <div class="mb-3">
        <select id="categorySelect" class="form-select">
            @foreach($products_categorized->keys() as $category_name)
            <option value="{{ camelCase($category_name) }}Products">{{ $category_name }}</option>
            @endforeach

            <option value="allCategories">All categories</option>
        </select>
    </div>

    <form action="{{ route('jobs.update.products', $job) }}" method="post" id="jobProductsForm">
        @method('patch')
        @csrf
        <div id="listProductsByCategory">
            @foreach($products_categorized as $category_name => $products)
            <div id="{{ camelCase($category_name) }}Products" class="<?= !$loop->first ? 'd-none' : '' ?> mb-3">
                <ul class="list-group">
                    <div class="list-group-item disabled">
                        <span class="badge text-bg-dark float-end">{{ $products->count() }}</span>
                        <b>{{ $category_name }}</b>
                    </div>
                    @foreach($products as $product)   
                    <?php $checkbox = (object) [
                        'id' => "product{$product->id}Checkbox",
                        'checked' => $job->products->contains( $product->id ),
                    ] ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="{{ $checkbox->id }}" name="products[]" value="{{ $product->id }}" {{ isChecked( $checkbox->checked ) }}>
                            <label class="form-check-label" for="{{ $checkbox->id }}">{{ $product->name }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>              
            @endforeach
        </div>
    </form>

    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-success" type="submit" form="jobProductsForm">Save products</button>
    </x-slot>
</x-modal>

@push('scripts')
<script>
const listProductsByCategory = {
    element: document.getElementById('listProductsByCategory'),
    children: function () {
        return  Array.from(this.element.children);
    },
    showOnly: function ($category_list_id) {
        this.children().forEach(function (child) {
            child.classList.toggle('d-none', child.id != $category_list_id);
        })
    },
    showAll: function () {
        this.children().forEach(function (child) {
            child.classList.remove('d-none');
        }) 
    }
}

const categorySelect = {
    element: document.getElementById('categorySelect'),
    listen: function () {
        let self = this;

        this.element.addEventListener('change', function (evt) {
            if( this.value != 'allCategories' ) {
                listProductsByCategory.showOnly(this.value)
            } else {
                listProductsByCategory.showAll()
            }
        })
    }
}
categorySelect.listen()
</script>
@endpush