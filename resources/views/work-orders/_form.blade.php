@csrf
@include('work-orders._form.schedule')
@include('work-orders._form.type')
@include('work-orders._form.job')
@include('work-orders._form.crew')
@include('work-orders._form.contractor')
@include('work-orders._form.notes')

@if( $request->filled('url_back') )
<input type="hidden" name="url_back" value="{{ $request->get('url_back') }}">
@endif
