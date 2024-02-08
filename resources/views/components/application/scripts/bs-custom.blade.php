<script>
document.querySelectorAll('.is-invalid').forEach(function (element) {
    
    let event = element.tagName == 'INPUT' ? 'keydown' : 'change';

    element.addEventListener(event, function (e) {
        this.classList.remove('is-invalid')
    })
})
</script>
