<button id="themeModeButton" class="{{ $attributes->get('class', '') }}" type="button" data-mode="light">
    <i class="bi bi-sun-fill"></i>
    @if( $attributes->get('text') == true )
    <span class="ms-2">Light mode</span>
    @endif
</button>

@push('scripts')
<script>
const htmlTag = document.querySelector('html')
const themeModeButton = {
  element: document.getElementById('themeModeButton'),
  listen: function () {
    
    this.element.addEventListener('click', function (evt) {
      let button = evt.target.closest('button')

      if( button.dataset.mode == 'light' )
      {
        htmlTag.dataset.bsTheme = 'light'
        button.dataset.mode = 'dark'
        button.querySelector('i').classList.replace('bi-sun-fill', 'bi-moon-stars')
        if( button.querySelector('span') ) {
            button.querySelector('span').textContent = 'Dark mode'
        }
      }
      else
      {
        htmlTag.dataset.bsTheme = 'dark'
        button.dataset.mode = 'light'
        button.querySelector('i').classList.replace('bi-moon-stars', 'bi-sun-fill')
        if( button.querySelector('span') ) {
            button.querySelector('span').textContent = 'Light mode'
        }
      }
    })

  }
}
themeModeButton.listen()
</script>
@endpush
