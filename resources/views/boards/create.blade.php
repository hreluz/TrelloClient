@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" id="form_add_trello_account">
                <div class="panel-heading">Create Board</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('boards.store', $account) }}">
                        {{ csrf_field() }}

                        @include('boards.partials.fields')

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection