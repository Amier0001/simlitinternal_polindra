<!-- Flash Alert -->
@if (Session::has('alert'))
<div id="flash-alert" data-flashalerticon="{{ Session::get('icon') }}" data-flashalert="{{ Session::get('alert') }}" data-flashsubalert="{{ Session::get('subalert') }}"></div>
@endif