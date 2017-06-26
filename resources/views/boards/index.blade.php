@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
				<div class="panel-heading">Boards from {{ $account->name }} Account</div>
                <div class="panel-body">
                    <a href="{{ route('boards.create', $account) }}" class="btn btn-primary text-center">Create Board</a>
                    @include('boards.partials.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection