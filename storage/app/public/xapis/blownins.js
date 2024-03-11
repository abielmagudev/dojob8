const blowninsRvalueNameSelect = {
    element: document.getElementById('blowninsRvalueNameSelect'),
    score: function () {
        let option = this.element.selectedOptions[0]
        return option.dataset.score
    },
    listen: function () {
        this.element.addEventListener('change', function () {
            blowninsBagsInput.calculate()
        })
    }
}
blowninsRvalueNameSelect.listen()

const blowninsSquareFootageInput = {
    element: document.getElementById('blowninsSquareFootageInput'),
    value: function () {
        return this.element.value;
    },
    listen: function () {
        this.element.addEventListener('input', function (evt) {
            blowninsBagsInput.calculate()
        })
    }
}
blowninsSquareFootageInput.listen()

const blowninsBagsInput = {
    element: document.getElementById('blowninsBagsInput'),
    validate: function (value) {
        return value != null && value != undefined && value != '' && value > 0;
    },
    calculate: function () {
        let rvalue_score = blowninsRvalueNameSelect.score();
        let square_footage_value = blowninsSquareFootageInput.value();
        let result = Math.ceil( square_footage_value / rvalue_score )
        this.setValue(result);
    },
    setValue: function (value) {
        this.element.value = value
    }
}
