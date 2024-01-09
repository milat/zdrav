@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <b>{{ __('domains.meal') }}</b>
                        <a href="{{route('meal.create')}}" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('actions.create') }}</a>
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
                                            <th scope="col" class="text-center">{{ __('fields.meal.date_time') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.meal.type') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.meal.score') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.meal.note') }}</th>
                                            <th scope="col" class="text-center">{{ __('actions.edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($meals as $meal)
                                            <tr>
                                                <td class="text-center">{{\App\Helpers\DateHelper::convertFormat($meal->date_time, true)}}</td>
                                                <th scope="row" class="text-center" style= "white-space: nowrap;">{{ __('seeded.'.$meal->type->description) }}</th>
                                                <td class="text-center" style="white-space: nowrap;">
                                                    @for($i = 1; $i <= $meal->score->value; $i++)
                                                        <i style="color: #ffc107" class="bi bi-star-fill"></i>
                                                    @endfor
                                                    @for($i = 1; $i <= 5 - $meal->score->value; $i++)
                                                        <i style="color: #ffe69c" class="bi bi-star"></i>
                                                    @endfor
                                                </td>
                                                <td class="text-center">
                                                    @if($meal->note)
                                                        <a class="modal-trigger" href="javascript:;" note="{{$meal->note}}">
                                                            <i class="bi bi-card-text"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('meal.edit', ['id' => $meal->id])}}" title="{{ __('actions.edit') }} {{ __('domains.meal') }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{ $meals->onEachSide(1)->links() }}

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('fields.meal.note') }}</h5>
                                    </div>
                                    <div class="modal-body"></div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel-model" class="btn btn-secondary" data-dismiss="modal"> {{ __('actions.dismiss') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.modal-trigger').on('click' , function(e){
            e.preventDefault();
            $('.modal-body').html($(this).attr('note'));
            $('#modal-content').modal('show');
        });

        $('#cancel-model').on('click', function(e){
            e.preventDefault();
            $('#modal-content').modal('hide');
        });
    </script>
@endsection
