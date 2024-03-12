<div id="floatingClientSuggestions">
    <form autocomplete="off" onsubmit="return false;">
        <input class="form-control rounded-pill px-4" type="search" placeholder="{{ $attributes->get('placeholder', 'Firstly, find the client...') }}" min="3">
    </form>

    <div class="position-absolute shadow rounded text-bg-white overflow-hidden mt-1 d-none">
        <div class="list-group list-group-flush rounded-top overflow-y-scroll" style="max-height:272px;"></div>
    </div>

    <template>
        <div>
            <a class="list-group-item list-group-item-action border-start-0 border-top-0 border-end-0">
                <b class="d-block"></b>
                <small></small>
            </a>
        </div>
    </template>
</div>

@push('scripts')
<script>
const floatingClientSuggestions = {
    element: document.getElementById('floatingClientSuggestions'),
    api: "<?= route('clients.ajax.search', ['search' => '']) ?>",
    url: "<?= $attributes->get('url', '#%7Bid%7D') ?>", // %7Bid%7D = {id}
    elements: function () {
        return {
            inputSelector: this.element.querySelector('input[type="search"]'),
            listSelector: this.element.querySelector('.list-group'),
            templateSelector: this.element.querySelector('template'),
        }
    },
    validate: function ($value) {
        return $value.length > 1;
    },
    send: async function ($value) {
        let response = await fetch(this.api + $value);
        let json = await response.json();
        return json;
    },
    template: function () {
        return this.elements().templateSelector.content.cloneNode(true);
    },
    fill: function ($clients) {
        let self = this;
        
        $clients.forEach(function ($client) {
            let cloned = self.template()
            let link = cloned.querySelector('a')
            let url = self.url;

            link.setAttribute('href', url.replace('%7Bid%7D', $client.id))
            link.querySelector('b').innerText = $client.full_name;
            link.querySelector('small').innerHTML = [$client.address_simple, $client.contact_channels].join('<br>')
            // element.innerText = ['string', null, 0].filter(x => !!x).join(', '); // Filter values

            self.elements().listSelector.appendChild(cloned)
        })

        return this;
    },
    render: function ($json) {
        if( $json.total == 0 ) {
            this.hide().empty();
            return;
        }

        this.empty().fill($json.clients).show();
    },
    show: function () {
        this.elements().listSelector.parentElement.classList.remove('d-none');
        return this;
    },
    hide: function () {
        this.elements().listSelector.parentElement.classList.add('d-none');
        return this;
    },
    clear: function () {
        this.elements().inputSelector.value = null;
        return this;
    },
    empty: function () {
        let children = this.elements().listSelector.children;

        for(child of children)
        {
            if(! child.classList.contains('list-group-item-locked') ) {
                child.remove()
            }
        }

        return this;
    },
    reset: function () {
        this.hide().clear().empty()
    },
    listen: function () {
        let self = this;
        let events = ['keyup', 'search'];

        events.forEach(function ($event) {

            self.elements().inputSelector.addEventListener($event, async function () {
                if(! self.validate(this.value) ) {
                    self.hide().empty()
                    return;
                }
    
                let json = await self.send(this.value)    
                self.render(json)
            })

        })
    }
}
floatingClientSuggestions.listen()

/**
 * Create query string for URL with Javascript
 * 
 * let data = new URLSearchParams({search: value});
 * url + data.toString();
 */
</script>
@endpush