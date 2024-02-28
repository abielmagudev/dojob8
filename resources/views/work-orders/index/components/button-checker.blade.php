<button id="checkerButton" class="btn btn-outline-primary btn-sm border-0">
    <i class="bi bi-check2-square"></i>
</button>

@push('scripts')  
@include('components.scripts.Checker')
<script>
const checker = new Checker('work_orders');
checker.listen()
</script>
@endpush
