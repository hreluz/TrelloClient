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

<form id="delete-form" method="POST" action="{{ route('boards.delete', [$account, 'DELETE_ID']) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete').click(function(e){
                e.preventDefault();

                let form = $('#delete-form');
                let url = $(this).data('delete');
                
                form.attr('action', url);
                form.submit();
            });
        });
    </script>
@endsection