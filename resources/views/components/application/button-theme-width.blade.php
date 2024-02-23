<button id="themeWidthButton" class="{{ $attributes->get('class', '') }}" type="button">
    <i class="bi"></i>
    <span class="mx-1"></span>
</button>

@push('scripts')
<script>
const themeWidthMain = {
  element: document.getElementById('main'),
  collapseWidth: 'container',
  expandWidth: 'container-fluid',
  widths: function () {
    return [
      this.collapseWidth,
      this.expandWidth,
    ]
  },
  setCookie: function ($value) {
    Cookies.set('theme-width', $value, {
      // HttpOnly: true,
      // secure: true,
      path: '/',
      sameSite: 'Lax',
    })
  },
  getCookie: function () {
    return Cookies.get('theme-width');
  },
  isExpanded: function () {
    return this.getCookie() == this.expandWidth;
  },
  toggle: function () {
    let change_width = this.isExpanded() ? this.collapseWidth : this.expandWidth;
    this.element.classList.remove(...this.widths());
    this.element.classList.add(change_width);
    this.setCookie(change_width);
  }
}

const themeWidthButton = {
  element: document.getElementById('themeWidthButton'),
  collapseButton: {
    icon: 'bi-arrows-collapse-vertical',
    text: 'Collapse',
  },
  expandButton: {
    icon: 'bi-arrows-expand-vertical',
    text: 'Expand',
  },
  icons: function () {
    return [
      this.collapseButton.icon,
      this.expandButton.icon,
    ]
  },
  setIcon: function () {
    let icon = themeWidthMain.isExpanded() ? this.collapseButton.icon : this.expandButton.icon;
    this.element.classList.remove(...this.icons());
    this.element.classList.add(icon);
  },
  setText: function () {
    let text = themeWidthMain.isExpanded() ? this.collapseButton.text : this.expandButton.text;
    this.element.querySelector('span').textContent = text;
  },
  refresh: function () {
    themeWidthButton.setIcon();
    themeWidthButton.setText();
  },
  listen: function () {
    this.element.addEventListener('click', function (evt) {
      evt.preventDefault();      
      themeWidthMain.toggle()
      themeWidthButton.refresh();
    })
  }
}
themeWidthButton.refresh();
themeWidthButton.listen();
</script>
@endpush
