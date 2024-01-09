@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>{{ __('domains.user') }}</b>
                    </div>
                    <div class="card-body">

                        @if (session('message'))
                            <div class="row" id="session-message">
                                <div class="col-12">
                                    <div class="alert alert-{{session('success')?'success':'danger'}} fade show" role="alert">
                                        {{session('message')}}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{route('user.update')}}">

                            @csrf
                            @method('patch')

                            <div class="form-group mt-2">
                                <label for="name" class="form-label">{{ __('fields.user.name') }}</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="email" class="form-label">{{ __('fields.user.email') }}</label>
                                <input type="text" name="email" disabled class="form-control" id="email" value="{{$user->email}}">
                            </div>

                            <div class="accordion mt-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-heading">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePassword" aria-expanded="false" aria-controls="collapsePassword">
                                            {{ __('actions.update') }} {{ __('fields.user.password') }}
                                        </button>
                                    </h2>
                                    <div id="collapsePassword" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading">
                                        <div class="accordion-body">
                                            <div class="form-group mt-2">
                                                <label for="current_password" class="form-label">{{ __('fields.user.password_current') }}</label>
                                                <input type="password" name="current_password" class="form-control" id="current_password">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label for="password_new" class="form-label">{{ __('fields.user.password_new') }}</label>
                                                <input type="password" name="password" class="form-control" id="password">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label for="password_confirmation" class="form-label">{{ __('fields.user.password_confirm') }}</label>
                                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3">{{ __('actions.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
