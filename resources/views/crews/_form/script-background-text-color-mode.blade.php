<script>
const backgroundColorInput = {
    element: document.getElementById('backgroundColorInput'),
    color: function () {
        return this.element.value;
    },
    listen: function () {
        this.element.addEventListener('input', function (evt) {
            textColorModeSwitch.changeBackgrounColor( evt.target.value );
        })
    }
}

const textColorModeSwitch = {
    element: document.getElementById('textColorModeSwitch'),
    textColors: {
        dark: "<?= $text_color_modes_colors['dark'] ?>",
        light: "<?= $text_color_modes_colors['light'] ?>",
    },
    changeBackgrounColor: function ($color) {
        this.element.nextElementSibling.querySelector('div:first-child').style.backgroundColor = $color
    },
    listen: function () {
        this.element.addEventListener('change', function (evt) {
            let wrapper = evt.target.nextElementSibling.querySelector('div:first-child');
            
            wrapper.style.color = evt.target.checked ? textColorModeSwitch.textColors.light : textColorModeSwitch.textColors.dark;
            wrapper.querySelectorAll('small')[0].classList.toggle('d-none', evt.target.checked)
            wrapper.querySelectorAll('small')[1].classList.toggle('d-none', !evt.target.checked)

        })
    }
}

backgroundColorInput.listen()
textColorModeSwitch.listen()
</script>
