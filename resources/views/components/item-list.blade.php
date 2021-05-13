<table class="table">
    <thead>
	<th scope="col">#</th>
        @foreach ($columns as $key => $column)
	    <th scope="col">{{ $column->label }}</th>
        @endforeach
    </thead>
    <tbody>
        @foreach ($rows as $i => $row)
	    <tr>
		<td>
		    <div class="form-check">
			<input type="checkbox" class="form-check-input" data-index="{{ $i }}">
		    </div>
		</td>
		@foreach ($columns as $column)
		    @if ($column->type == 'string')
			<td>{{ $row[$column->id] }}</td>
		    @elseif ($column->type == 'array')
			<td>
			    @foreach ($row[$column->id] as $value)
				{{ $value }}
			    @endforeach
			</td>
		    @endif
		@endforeach
	    </tr>
        @endforeach
    </tbody>

</table>
