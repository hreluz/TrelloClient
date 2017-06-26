@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
				<div class="panel-heading">List from  Board {{ $board->name }}</div>
                <div class="panel-body">
                    <a href="{{ route('lists.create', [$account, $board]) }}" class="btn btn-primary text-center">Create List</a>
                    @include('lists.partials.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection