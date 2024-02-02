<x-modal id="modalMembersFilters" title="Member filters" header-close>
    <form action="{{ route('members.index') }}" method="get" autocomplete="off" id="formMemberFilters">
        @include('members.index.modal-filters.status')
        @include('members.index.modal-filters.crew-member')
        @include('components.custom.select-sort')
    </form>

    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-success" type="submit" form="formMemberFilters" name="fltr" value="on">Set filters on Members</button>
    @endslot
</x-modal>
