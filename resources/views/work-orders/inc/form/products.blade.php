<x-form-field-horizontal for="productControlComponent" label="Products">
    <div id="productControlComponent" class="bg-body-tertiary rounded p-3">

        <div id="productControl" class="row g-3 mb-3">
            <div class="col-sm">
                <select class="form-select">
                    <option disabled selected label="Product..."></option>
                </select>
            </div>
            <div class="col-sm">
                <input class="form-control" type="number" placeholder="Quantity">
            </div>
            <div class="col-sm">
                <input class="form-control" type="text" placeholder="Indications (Optional)">
            </div>
            <div class="col-sm col-sm-1">
                <button class="btn btn-primary w-100" type="button">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>
    
        <div id="productList">
            @if( $work_order->id )
            @foreach($work_order->products as $product)
            <div>
                <div class="row g-3 mb-3">
                    <div class="col-sm">
                        <div class="form-control">{{ $product->name }}</div>
                    </div>
                    <div class="col-sm">
                        <div class="form-control">{{ $product->pivot->quantity }} {{ $product->measurement_unit }}</div>
                    </div>
                    <div class="col-sm">
                        <div class="form-control"><?= ! empty($product->pivot->indications) ? $product->pivot->indications : '&nbsp;' ?></div>
                    </div>
                    <div class="col-sm col-sm-1">
                        <?php $value_json = jsonEncodeHtml([
                            'id' => $product->id, 
                            'quantity' => $product->pivot->quantity,
                            'indications' => $product->pivot->indications,
                        ]) ?>
                        <input type="hidden" name="products[]" value="<?= $value_json ?>">
                        <button class="btn btn-outline-danger w-100" type="button">
                            <i class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <template>
            <div>
                <div class="row g-3 mb-3">
                    <div class="col-sm">
                        <div class="form-control"></div>
                    </div>
                    <div class="col-sm">
                        <div class="form-control"></div>
                    </div>
                    <div class="col-sm">
                        <div class="form-control"></div>
                    </div>
                    <div class="col-sm col-sm-1">
                        <input type="hidden" name="products[]">
                        <button class="btn btn-outline-danger w-100" type="button">
                            <i class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
    
</x-form-field-horizontal>

@push('scripts')
<script>
const jobSelect = {
    element: document.getElementById('jobSelect'),
    api: "<?= route('jobs.get.products', '?') ?>",
    request: async function ($value) {
        let url = this.api.replace('?', $value);
        let response = await fetch(url);
        let json = await response.json();
        return json;
    },
    listen: function () {
        let self = this;

        if( this.element )
        {
            this.element.addEventListener('change', async function (evt) {
                let json = await self.request(this.value)
                productControlComponent.resetControl();
                productControlComponent.productsSelectLoader(json);
            })
        }
    }
}
jobSelect.listen()

const productControlComponent = {
    element: document.getElementById('productControlComponent'),
    first_option_products_select: document.getElementById('productControlComponent').querySelector('select option:first-child').cloneNode(true),
    productsSelectLoader: function ($products_json) {
        let productSelect = this.productSelect()

        productSelect.innerHTML = '';

        productSelect.appendChild( this.first_option_products_select );

        productSelect.options[0].selected;

        $products_json.forEach(product => {
            const option = document.createElement('option');
            option.value = product.id;
            option.textContent = product.name;
            option.setAttribute('data-product', JSON.stringify({
                id: product.id,
                name: product.name,
                description: product.description,
                measurement_unit: product.measurement_unit,
            }));

            productSelect.appendChild(option);
        });
    },
    productSelect: function () {
        return this.element.querySelector('select');
    },
    quantityInput: function () {
        return this.element.querySelector('input[type="number"]');
    },
    indicationsInput: function () {
        return this.element.querySelector('input[type="text"]');
    },
    productTemplate: function () {
        return this.element.querySelector('template');
    },
    cloneProductTemplate: function () {
        return document.importNode(this.productTemplate().content, true)
    },
    productList: function () {
        return this.element.querySelector('#productList')
    },
    addProduct: function () {
        let option_selected = this.productSelect().options[this.productSelect().selectedIndex];

        let product = JSON.parse(option_selected.dataset.product);

        let data = {
            id: product.id,
            quantity: this.quantityInput().value,
            indications: this.indicationsInput().value,
        }

        let cloned = this.cloneProductTemplate();

        let textFormControls = cloned.querySelectorAll('.form-control');

        textFormControls[0].textContent = product.name;
        textFormControls[1].textContent = `${data.quantity} ${product.measurement_unit}`;
        textFormControls[2].innerHTML = this.indicationsInput().value != '' ? this.indicationsInput().value : '&nbsp;';
        cloned.querySelector('input[name^="products"]').value = JSON.stringify(data)

        this.productList().appendChild(cloned)

        this.resetControl();
    },
    removeProduct: function (clicked) {
        clicked.closest('.row').remove()
    },
    validate: function () {
        if( this.productSelect().value === '' || this.productSelect().value === null ) {
            this.productSelect().focus();
            return false;
        }

        if( this.quantityInput().value === '' || this.quantityInput().value === null ) {
            this.quantityInput().focus();
            return false;
        }

        return true;
    },
    resetControl: function () {
        this.productSelect().selectedIndex = 0;
        this.quantityInput().value = '';
        this.indicationsInput().value = '';
    },
    listen: function () {
        let self = this;

        this.element.addEventListener('click', function (evt) {
            let button = evt.target;

            if( button.closest('.btn-primary') ) {
                if( self.validate() ) {
                    self.addProduct()
                }
            }

            if( button.closest('.btn-outline-danger') ) {
                self.removeProduct(button)
            }
        })
    }
}
productControlComponent.listen()

<?php if( $work_order->id ): ?>
productControlComponent.productsSelectLoader(<?= $work_order->job->products ?>)
<?php endif ?>
</script>  
@endpush
