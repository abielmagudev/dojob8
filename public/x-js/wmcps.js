if( typeof wmcpsProductComponent == 'undefined' )
{
    const wmcpsProductComponent = {
        element: document.getElementById('wmcpsProductsComponent'),
        container: document.getElementById('wmcpsProductsOrder'),
        template: function (setup) {
            let clone = this.element.querySelector('template').content.cloneNode(true);

            clone.querySelector('span.product').textContent = setup.product.text
            clone.querySelector('input[name="products[]"]').value = setup.product.value
            clone.querySelector('span.quantity').textContent = setup.quantity.text
            clone.querySelector('input[name="quantities[]"]').value = setup.quantity.value

            return clone;
        },
        listen: function () {
            this.element.addEventListener('click', (e) => {
                if(! e.target.matches('button.btn-primary, button.btn-primary > b') ) {
                    return;
                }
                
                let selectProduct = this.element.querySelector('#selectProduct')
                if( selectProduct.value == '' )
                {
                    selectProduct.focus()
                    return;
                }

                let inputQuantity = this.element.querySelector('#inputQuantity')
                if( inputQuantity.value == '' || inputQuantity.value < 1 )
                {
                    inputQuantity.focus()
                    return;
                }

                this.container.appendChild(
                    this.template({
                        product: {
                            text: selectProduct.options[ selectProduct.selectedIndex ].textContent,
                            value: selectProduct.value,
                        },
                        quantity: {
                            text: inputQuantity.value,
                            value: inputQuantity.value,
                        }
                    })
                )

                selectProduct.selectedIndex = 0
                inputQuantity.value = ''
            })

            this.container.addEventListener('click', function (e) {
                if(! e.target.matches('button.btn-outline-danger, button.btn-outline-danger > b') ) {
                    return;
                }

                e.target.closest('.row').remove()
            })
        }
    }
    wmcpsProductComponent.listen()
}
