@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <b>{{ __('domains.training_category') }}</b>
                        <div>
                            <a href="{{route('training.view')}}" class="btn btn-outline-secondary btn-sm">{{ __('domains.training') }}</a>
                            <a href="{{route('training_category.create')}}" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('actions.create') }}</a>
                        </div>
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
                        <div class="row">
                            <div class="col-12 table-responsive-md">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">{{ __('fields.training_category.description') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.training_category.is_active') }}</th>
                                            <th scope="col" class="text-center">{{ __('actions.edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($training_categories as $training_category)
                                            <tr>
                                                <th scope="row" class="text-center" style= "white-space: nowrap;">{{$training_category->description}}</th>
                                                <td class="text-center">@if ($training_category->is_active) {{ __('actions.active') }} @else {{ __('actions.inactive') }} @endif</td>
                                                <td class="text-center">
                                                    <a href="{{route('training_category.edit', ['id' => $training_category->id])}}" title="{{ __('actions.edit') }} {{ __('domains.training_category') }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{ $training_categories->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
