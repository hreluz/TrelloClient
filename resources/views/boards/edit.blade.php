@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $board->name }} board</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('boards.update', [$account,$board]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('boards.partials.fields')

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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