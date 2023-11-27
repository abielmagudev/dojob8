<script>
const selectedJob = {
    element: document.getElementById('selectJob'),
    listen: function (resource_url) {
        this.element.addEventListener('change', function ()
        {            
            let option = this.options[this.selectedIndex];

            if( option.dataset.hasExtensions > 0 ) {
                extensionsLoader.get( resource_url.replace('?', this.value) );
            }
            else {
                extensionsLoader.reset()
            }
        })
    }
}
</script>
