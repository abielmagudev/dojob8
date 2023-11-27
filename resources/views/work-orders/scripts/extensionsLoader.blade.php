<script>

const extensionsLoader = {
    element: document.getElementById('extensions'),
    elements: function () {
        if( this.elements_cache == undefined )
        {
            this.elements_cache = {
                container: this.element.querySelector('#container'),
                loading: this.element.querySelector('#loading'),
                template: this.element.querySelector('#template'),
                templates: this.element.querySelector('#templates'),
                body: document.body,
            }
        }

        return this.elements_cache;
    },
    loading: function (display) {
        this.elements().loading.classList.toggle('d-none', !display);
    },
    show: function () {
        this.elements().container.classList.remove('d-none');
        return this;
    },
    hide: function () {
        this.elements().container.classList.add('d-none');
        return this;
    },
    clear: function () {
        this.elements().templates.innerHTML = '';
        return this;
    },
    clone: function (content) {
        return this.elements().template.content.cloneNode(true);
    },
    reset: function () {
        this.clear().hide();
    },
    render: function (templates) {

        templates.forEach( template => {
            let clone = this.clone()
            clone.firstElementChild.innerHTML = template
            this.elements().templates.appendChild(clone)
        });

        document.querySelectorAll('script[fake]').forEach( script_fake => {
            // Remove the loaded script to recreate it 
            document.querySelectorAll(`script[src="${script_fake.src}"]`).forEach(script_loaded => {
                script_loaded.remove()
            })
            
            // Recreates the fake script with an active script 
            let script = document.createElement('script')
            script.src = script_fake.src

            this.elements().body.appendChild(script)
        })
    },
    request: async function (resource_url) {
        this.loading(true)
        let data = await fetch(resource_url);
        let json = await data.json();
        this.loading(false)
        return json;
    },
    get: async function (resource_url) {
        this.reset()

        let response = await this.request(resource_url);

        if( response.templates.length > 0 ) {
            this.render(response.templates);
            this.show();
        }
    }
}
</script>
