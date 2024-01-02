@csrf

@isset($client)
<input type="hidden" name="client" value="{{ $client->id }}">  
@endisset

@include('work-orders._form.schedule')
@include('work-orders._form.job')
@include('work-orders._form.extensions')
@include('work-orders._form.contractor')
@include('work-orders._form.crew')
@include('work-orders._form.notes')

@includeWhen(is_int($work_order->id),'work-orders._form.status')
