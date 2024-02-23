<button id="themeModeButton" class="{{ $attributes->get('class', '') }}" type="button">
    <i class="bi"></i>
    <span class="mx-1"></span>
</button>

@push('scripts')
<script>
const themeModeHtml = {
  element: document.querySelector('html'),
  darkMode: 'dark',
  lightMode: 'light',
  modes: function () {
    return [
      this.darkMode,
      this.lightMode,
    ];
  },
  getCookie: function () {
    return Cookies.get('theme-mode');
  },
  setCookie: function ($mode) {
    Cookies.set('theme-mode', $mode, {
      // HttpOnly: true,
      // secure: true,
      path: '/',
      sameSite: 'Lax',
    });
  },
  setData: function ($mode) {
    this.element.dataset.bsTheme = $mode;
  },
  isLightMode: function () {
    return this.getCookie() == this.lightMode;
  },
  toggle: function () {
    let mode = this.isLightMode() ? this.darkMode : this.lightMode;
    this.setData(mode);
    this.setCookie(mode)
  }
}

const themeModeButton = {
  element: document.getElementById('themeModeButton'),
  darkButton: {
    icon: 'bi-moon-stars',
    text: 'Dark mode',
  },
  lightButton: {
    icon: 'bi-sun-fill',
    text: 'Light mode',
  },
  icons: function () {
    return [
      this.darkButton.icon,
      this.lightButton.icon,
    ];
  },
  setIcon: function () {
    let icon = themeModeHtml.isLightMode() ? this.darkButton.icon : this.lightButton.icon;
    let i = this.element.querySelector('i');
    i.classList.remove(...this.icons());
    i.classList.add(icon)
  },
  setText: function () {
    let text = themeModeHtml.isLightMode() ? this.darkButton.text : this.lightButton.text;
    this.element.querySelector('span').textContent = text;
  },
  refresh: function () {
    this.setIcon();
    this.setText();
  },
  listen: function () {
    this.element.addEventListener('click', function (evt) {
      themeModeHtml.toggle()
      themeModeButton.refresh()
    })
  }
}
themeModeButton.refresh();
themeModeButton.listen();
</script>
@endpush
