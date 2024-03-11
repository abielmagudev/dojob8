const celluloseinsRvalueNameSelect = {
    element: document.getElementById('celluloseinsRvalueNameSelect'),
    score: function () {
        let option = this.element.selectedOptions[0]
        return option.dataset.score
    },
    listen: function () {
        this.element.addEventListener('change', function () {
            celluloseinsBagsInput.calculate()
        })
    }
}
celluloseinsRvalueNameSelect.listen()

const celluloseinsSquareFootageInput = {
    element: document.getElementById('celluloseinsSquareFootageInput'),
    value: function () {
        return this.element.value;
    },
    listen: function () {
        this.element.addEventListener('input', function (evt) {
            celluloseinsBagsInput.calculate()
        })
    }
}
celluloseinsSquareFootageInput.listen()

const celluloseinsBagsInput = {
    element: document.getElementById('celluloseinsBagsInput'),
    validate: function (value) {
        return value != null && value != undefined && value != '' && value > 0;
    },
    calculate: function () {
        let rvalue_score = celluloseinsRvalueNameSelect.score();
        let square_footage_value = celluloseinsSquareFootageInput.value();
        let result = Math.ceil( square_footage_value / rvalue_score )
        this.setValue(result);
    },
    setValue: function (value) {
        this.element.value = value
    }
}
