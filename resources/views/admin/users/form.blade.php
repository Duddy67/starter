@extends ('layouts.admin')

@section ('main')
    @php $action = (isset($user)) ? route('admin.users.update', ['id' => $user->id]) : route('admin.users') @endphp
    <form method="post" action="{{ $action }}" id="itemForm">
        @csrf
        @foreach ($fields as $attribs)
	    @php if (isset($user)) { 
		     $value = old($attribs->name, $attribs->value);
		 }
		 else {
		     $value = old($attribs->name);
		 }
	    @endphp
	    <x-input :attribs=$attribs :value=$value />
        @endforeach
	<input type="hidden" id="listUrl" value="{{ route('admin.users') }}">
    </form>
    <x-toolbar :items=$actions />
@endsection

@push ('scripts')
    <script type="text/javascript" src="{{ url('/') }}/vendor/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/plugins/jquery-ui/jquery-ui.min.css"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/admin/datepicker.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/admin/form.js"></script>
@endpush
