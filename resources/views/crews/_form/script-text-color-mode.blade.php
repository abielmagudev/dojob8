<script>
const textColorModeSwitcher = {
    element: document.getElementById('textColorModeSwitch'),
    floated: document.getElementById('textColorModeFloating'),
    colors: {
        dark: "<?= $text_color_modes_colors['dark'] ?>",
        light: "<?= $text_color_modes_colors['light'] ?>",
    },
    listen: function () {
        this.element.addEventListener('change', function (evt) {            
            textColorModeSwitcher.floated.style.color = evt.target.checked ? textColorModeSwitcher.colors.light : textColorModeSwitcher.colors.dark;
            textColorModeSwitcher.floated.textContent = evt.target.checked ? 'light' : 'dark';
        })
    }
}

textColorModeSwitcher.listen()
</script>
