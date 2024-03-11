if( typeof wcpsComponent == 'undefined' )
{
    const wcpsComponent = {
        element: document.getElementById('wcpsProductComponent'),
        container: document.getElementById('wcpsProductsWorkOrder'),
        template: function (setup) {
            let clone = this.element.querySelector('template').content.cloneNode(true);

            clone.querySelector('span.product').textContent = setup.product.text
            clone.querySelector('input[name="products[]"]').value = setup.product.value
            clone.querySelector('span.quantity').textContent = setup.quantity.text
            clone.querySelector('input[name="quantities[]"]').value = setup.quantity.value
            clone.querySelector('span.indications').textContent = setup.indications.text
            clone.querySelector('input[name="indications[]"]').value = setup.indications.value

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

                let indicationsInput = this.element.querySelector('#indicationsInput')

                this.container.appendChild(
                    this.template({
                        product: {
                            text: selectProduct.options[ selectProduct.selectedIndex ].textContent,
                            value: selectProduct.value,
                        },
                        quantity: {
                            text: inputQuantity.value,
                            value: inputQuantity.value,
                        },
                        indications: {
                            text: indicationsInput.value,
                            value: indicationsInput.value,
                        }
                    })
                )

                selectProduct.selectedIndex = 0
                inputQuantity.value = ''
                indicationsInput.value = ''
            })

            this.container.addEventListener('click', function (e) {
                if(! e.target.matches('button.btn-outline-danger, button.btn-outline-danger > b') ) {
                    return;
                }

                e.target.closest('.row').remove()
            })
        }
    }
    wcpsComponent.listen()
}
