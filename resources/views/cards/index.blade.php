@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
				<div class="panel-heading">Cards from List {{ $list->name }}</div>
                <div class="panel-body">
                    <a href="{{ route('cards.create', [$account, $list]) }}" class="btn btn-primary text-center">Create Card</a>
                    @include('cards.partials.table')                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
