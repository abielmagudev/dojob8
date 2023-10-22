<script>
const selectJob = {
    element: document.getElementById('selectJob'),
    listen: function () {

        this.element.addEventListener('change', function () {
            extensionsJob.reset();
            
            let option = this.options[this.selectedIndex]

            if( option.dataset.hasExtensions > 0 ) {
                extensionsJob.load(this.value)
            }
        })

    },
    dispatchChangeEvent: function () {
        this.element.dispatchEvent( new Event('change') )
    }
}
selectJob.listen()
</script>
