<button id="buttonCollapseExpand" class="{{ $attributes->get('class', '') }}" type="button">
    <i class="bi bi-arrows-collapse-vertical"></i>
    <span class="ms-2">Collapse</span>
</button>

@push('scripts')
<script>
  const mainContainer = document.getElementById('main');
  
  document.getElementById('buttonCollapseExpand').addEventListener('click', function (evt) {
      let button = evt.target.closest('button')

      if( mainContainer.classList.contains('container') )
      {
        mainContainer.classList.replace('container', 'container-fluid')
        button.querySelector('i').classList.replace('bi-arrows-expand-vertical', 'bi-arrows-collapse-vertical')
        button.querySelector('span').textContent = 'Collapse'
      } 
      else
      {
        mainContainer.classList.replace('container-fluid', 'container')
        button.querySelector('i').classList.replace('bi-arrows-collapse-vertical', 'bi-arrows-expand-vertical')
        button.querySelector('span').textContent = 'Expand'
      }
  })
  </script>
@endpush
