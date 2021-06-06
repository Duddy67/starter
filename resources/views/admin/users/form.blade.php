@extends ('layouts.admin')

@section ('main')
@php var_dump(auth()->user()->isAllowedTo('create-role')); @endphp
    @php $action = (isset($user)) ? route('admin.users.update', $user->id) : route('admin.users.store') @endphp
    <form method="post" action="{{ $action }}" id="itemForm">
        @csrf

	@if (isset($user))
	    @method('put')
	@endif

        @foreach ($fields as $attribs)
	    @php if (isset($user)) { 
		     $value = old($attribs->name, $attribs->value);
                     // Users cannot change their role.
                     if ($attribs->name == 'role' && auth()->user()->id == $user->id) {
                         $attribs->extra = ['disabled'];
                     }
		 }
		 else {
                     if ($attribs->name == 'created_at' || $attribs->name == 'updated_at') {
                         continue;
                     }

		     $value = old($attribs->name);
		 }
	    @endphp

	    <div class="form-group">
		<x-input :attribs="$attribs" :value="$value" />
	    </div>
        @endforeach
	<input type="hidden" id="listUrl" value="{{ route('admin.users.index') }}">
	<input type="hidden" id="close" name="_close" value="0">
    </form>

    <div class="form-group">
	<x-toolbar :items=$actions />
    </div>

    @if (isset($user))
	<form id="deleteItemForm" action="{{ url('/admin/users', ['id' => $user->id]) }}" method="post">
	    @method('delete')
	    @csrf
	</form>
    @endif
@endsection

@push ('scripts')
    <script type="text/javascript" src="{{ url('/') }}/vendor/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/plugins/jquery-ui/jquery-ui.min.css"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/admin/datepicker.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/admin/form.js"></script>
@endpush
