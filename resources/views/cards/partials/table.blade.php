<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($cards as $card)
			<tr>
				<td>{{ $card->name }}</td>
				<td>
					<a href="{{ route('cards.edit', [$account, $list, $card]) }}">Edit</a>| 
					<a href="#" class="archived" data-id="{{ $card->id }}" data-archived="{{ route('cards.archived', [$account, $list, $card])}}">Archive</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>