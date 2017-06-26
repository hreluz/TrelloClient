@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="alert alert-warning">
                <div id="warning_alert">Disable Add Block Plus if you have it, refresh and check the pop-up.</div>
            </div>

            <div class="panel panel-default hidden" id="form_add_trello_account">
                <div class="panel-heading">Add Trello Account</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('trello_accounts.store') }}">
                        {{ csrf_field() }}

                        @include('trello_accounts.partials.fields')

                        <input id="trello_token" type="text" class="form-control hidden" name="trello_token" value="{{ old('trello_token') }}" >

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
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

@section('scripts')
    <script src="https://api.trello.com/1/client.js?key={{ env('TRELLO_KEY') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            let form = $('#form_add_trello_account');
            let trello_token = $('#trello_token');

            if(trello_token.val().length > 0 )
            {
                form.removeClass('hidden');

            }else{
                var authenticationSuccess = function() { 
                    trello_token.val(Trello.token());
                    form.removeClass('hidden');
                    localStorage.clear();
                };

                var authenticationFailure = function() { 
                    localStorage.clear();
                };

                Trello.authorize({
                  type: 'popup',
                  name: 'Getting Started Application',
                  scope: {
                    read: 'true',
                    write: 'true' },
                  expiration: 'never',
                  success: authenticationSuccess,
                  error: authenticationFailure
                });
            }
        });
    </script>
@endsection
