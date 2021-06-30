<!-- Modal -->
<!-- Theme style -->
<link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/css/adminlte.min.css">
<!-- Custom style -->
<link rel="stylesheet" href="{{ url('/') }}/css/admin/style.css">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/plugins/fontawesome-free/css/all.min.css">
<script src="{{ url('/') }}/vendor/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="{{ url('/') }}/vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/vendor/bootstrap-4.5.3/css/bootstrap.min.css">
<!-- Select2 Plugin -->
<script type="text/javascript" src="{{ url('/') }}/vendor/adminlte/plugins/select2/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/plugins/select2/css/select2.min.css"></script>

<div class="container-fluid">
    @include ('layouts.flash-message')

    <div class="card">
	<div class="card-body">
	    <x-filters :filters="$filters" :url="$url" />
	</div>
    </div>

    @if (!empty($rows)) 
	<table id="item-list" class="table table-hover table-striped">
	    <thead class="table-success">
		<th scope="col">
		    <input type="checkbox" id="toggle-select">
		</th>
		@foreach ($columns as $key => $column)
		    <th scope="col">
			@lang ($column->label)
		    </th>
		@endforeach
		<th scope="col">
		</th>
	    </thead>
	    <tbody>
		@foreach ($rows as $i => $row)
		     @php 
		          //echo $items[$i]->file_name;
			 //$query = $url['query'];
			 //$query[$url['item_name']] = $row['item_id'];
		    @endphp
		    <tr class="" >
			<td>
			    <div class="form-check">
				<input type="checkbox" class="form-check-input" data-item-id={{ $row['item_id'] }} data-index="{{ $i }}">
			    </div>
			</td>
			@foreach ($columns as $column)
			    @if ($column->name == 'file_name')
				<td>
                                    <a href="#" onClick="selectFile(this);" data-disk-name="{{ $items[$i]->disk_name }}" data-file-name="{{ $items[$i]->file_name }}" data-file-url="{{ $items[$i]->url }}">
                                {{ $row[$column->name] }}</td>
                                    </a>
			    @else
				<td>{{ $row[$column->name] }}</td>
                            @endif
			@endforeach
			<td>
                            <a href="#" onClick="deleteDocument(this)" data-document-id="{{ $items[$i]->id }}">
			    <i class="nav-icon fas fa-trash"></i></a>
			</td>
		    </tr>
		@endforeach
	    </tbody>

	</table>
    @else
        <div class="alert alert-info" role="alert">
	    No item has been found.
	</div>
    @endif

    <x-pagination :items=$items />

    <form method="post" action="{{ route('documents.index') }}" id="itemForm" enctype="multipart/form-data">
	@csrf
	@method('post')
	<input type="file" name="upload">
	<input type="submit" value="Upload file">
    </form>

    <form id="deleteDocument" action="{{ route('documents.index', $query) }}" method="post">
	@method('delete')
	@csrf
	<input type="hidden" id="documentId" name="document_id" value="">
    </form>
</div>

<script src="{{ asset('/js/admin/list.js') }}"></script>

<script>
function selectFile(element)
{
    //alert(element.dataset.diskName);
    var value = {
	disk_name: element.dataset.diskName,
	file_name: element.dataset.fileName,
	file_url: element.dataset.fileUrl
    };

    window.parent.postMessage({
        mceAction: 'execCommand',
	cmd: 'iframeCommand',
	value
    }, origin);
}

function deleteDocument(element)
{
    alert(element.dataset.documentId);
    document.getElementById('documentId').value = element.dataset.documentId;
    document.getElementById('deleteDocument').submit();
}
</script>