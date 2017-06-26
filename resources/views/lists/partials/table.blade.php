<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($lists as $list)
			<tr>
				<td>{{ $list->name }}</td>
				<td>
					<a href="{{ route('lists.edit', [$account, $board, $list]) }}">Edit</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>