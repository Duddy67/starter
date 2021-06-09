@if ($items->count())
    <div class="d-flex justify-content-center pt-5">
	{{ $items->appends(request()->except(['page']))->links('pagination::bootstrap-4') }}
    </div>

    <div class="d-flex justify-content-center">
	<span>
	    Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results.
	</span>
    </div>
@endif
