<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($boards as $board)
			<tr>
				<td>{{ $board->name }}</td>
				<td></td>
			</tr>
		@endforeach
	</tbody>
</table>