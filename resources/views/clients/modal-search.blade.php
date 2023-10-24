<x-modal id="modalSearchClient" title="Search client">
    
    {{-- Input --}}
    <form action="#!" autocomplete="off">
        <input id="inputSearchClient" class="form-control rounded-pill px-3" type="search" name="client" placeholder="By name, address, email..." required>
    </form>

    {{-- List wrapper --}}
    <div class="position-relative mt-1">

        {{-- List float --}}
        <div class="position-absolute shadow rounded bg-white p-1 w-100 d-none">
            <div class="list-group list-group-flush overflow-y-scroll is-hidden" id="clientsList" style="max-height:272px;"></div>

            {{-- Template list item --}}
            <template id="templateClientItem">
                <a href="{{ route('orders.create', '?') }}" class="list-group-item list-group-item-action">
                    <b class="d-block"></b>
                    <small class="d-block"></small>
                    <small class="d-block"></small>
                    <small class="d-block"></small>
                </a>
            </template>
        </div>
    </div>
    <div class="mt-2 text-center">
        <span class="text-secondary">...or</span>
        <a href="{{ route('clients.create') }}">create new client</a>
    </div>
</x-modal>

@push('scripts')
<script>
const modalSearchClient = {
    element: document.getElementById('modalSearchClient'),
    listen: function () {
        this.element.addEventListener('hidden.bs.modal', () => {
            inputSearchClient.clear()
            clientsList.clear().hide()
        })
    }
}
modalSearchClient.listen();

const inputSearchClient = {
    element: modalSearchClient.element.querySelector('#inputSearchClient'),
    api: "<?= route('clients.ajax.search') ?>?search=",
    clear: function () {
        this.element.value = ''
    },
    request: async function (value) {
        let response = await fetch(this.api + value);
        let json = await response.json();
        return json;
    },
    listen: function () {
        let self = this

        this.element.addEventListener('keyup', async function (e) {
            if( e.target.value.length > 2 )
            {
                let response = await self.request(e.target.value)
                clientsList.fill( response.clients )
            }
            else
            {
                clientsList.clear().hide()
            }
        })

        this.element.addEventListener('search', function () {
            clientsList.clear().hide()
        })
    }
}
inputSearchClient.listen()

const clientsList = {
    element: modalSearchClient.element.querySelector('#clientsList'),
    templateElement: modalSearchClient.element.querySelector('#templateClientItem'),
    template: function () {
        return this.templateElement.content.cloneNode(true);
    },
    fill: function (clients) {

        if( clients.length  == 0 )
        {
            this.clear().hide()
            return false;
        }
        
        this.clear().show()

        let self = this

        clients.forEach(function ($client) {
            let cloned = self.template();
            let link = cloned.querySelector('a')

            link.setAttribute('href', link.href.replace('?', $client.id))
            link.children[0].innerText = $client.name + ' ' + $client.lastname;
            link.children[1].innerText = $client.address + ', ' + $client.zip_code;
            link.children[2].innerText = [$client.city, $client.state, $client.country].filter(x => !!x).join(', ');
            link.children[3].innerText = [$client.email, $client.phone_number, $client.mobile_number].filter(x => !!x).join(', ');
        
            self.element.appendChild(link)
        })
    },
    clear: function () {
        for(item of this.element.children)
        {
            if(! item.classList.contains('list-group-item-locked') )
                item.remove()
        }

        return this
    },
    show: function () {
        this.element.parentNode.classList.remove('d-none')
        return this
    },
    hide: function () {
        this.element.parentNode.classList.add('d-none')
        return this
    }
}

/*

*** Create query string for URL ***
# let data = new URLSearchParams({search: value}); 
# url + data.toString();

*/
</script>
@endpush
