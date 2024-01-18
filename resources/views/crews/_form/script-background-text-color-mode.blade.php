<x-form-control-horizontal>
    <x-slot name="label">
        <label class="form-label">Colors</label>
    </x-slot>

    <div class="row">
        <div class="col-md">
            <input id="backgroundColorInput" type="color" class="form-control form-control-color w-100" name="background_color" value="{{ old('background_color', ($crew->background_color ?? '#333333')) }}">
            <x-form-feedback error="background_color">Background color</x-error>
        </div>
        <div class="col-md">
            <div class="form-control form-control-color w-100">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="textColorModeSwitch" name="text_color_mode" value="light" {{ isChecked( old('text_color_mode', $crew->text_color_mode) == 'light' ) }}>
                    <label class="form-check-label text-capitalize w-100" for="textColorModeSwitch">
                      
                        <div class="px-2 rounded text-center" style="background-color:{{ $crew->background_color }}; color:{{ $crew->text_color }}">
                            <small class="{{ $crew->text_color_mode == 'dark' || is_null($crew->text_color_mode) ? 'd-block' : 'd-none' }}">
                                <b>DARK</b>
                            </small>
                            <small class="{{ $crew->text_color_mode == 'light' ? 'd-block' : 'd-none' }}">
                                <b>LIGHT</b>
                            </small>
                        </div>

                    </label>
                </div>
            </div>
            <x-form-feedback error="text_color_mode">Text color mode</x-error>
        </div>
    </div>
</x-form-control-horizontal>

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
