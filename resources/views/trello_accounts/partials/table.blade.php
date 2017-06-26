<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($accounts as $account)
			<tr>
				<td>{{ $account->name }}</td>
				<td><a href="{{ route('boards.index', $account) }}">See Boards</a></td>
			</tr>
		@endforeach
	</tbody>
</table>