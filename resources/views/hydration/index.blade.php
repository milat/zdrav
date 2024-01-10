@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <b>{{ __('domains.hydration') }}</b>
                        <a href="{{route('hydration.create')}}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-plus"></i> {{ __('actions.create') }}</a>
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
                                            <th scope="col" class="text-center">{{ __('fields.hydration.date') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.hydration.amount') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.hydration.score') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.hydration.note') }}</th>
                                            <th scope="col" class="text-center">{{ __('actions.edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hydrations as $hydration)
                                            <tr>
                                                <td class="text-center">{{\App\Helpers\DateHelper::convertFormat($hydration->date)}}</td>
                                                <th scope="row" class="text-center" style= "white-space: nowrap;">{{ $hydration->amount }} {{$hydration->unit->abbreviation}}</th>
                                                <td class="text-center" style="white-space: nowrap;">
                                                    @for($i = 1; $i <= $hydration->score->value; $i++)
                                                        <i style="color: #ffc107" class="fa-solid fa-star"></i>
                                                    @endfor
                                                    @for($i = 1; $i <= 5 - $hydration->score->value; $i++)
                                                        <i style="color: #ffe69c" class="fa-regular fa-star"></i>
                                                    @endfor
                                                </td>
                                                <td class="text-center">
                                                    @if($hydration->note)
                                                        <a class="modal-trigger" href="javascript:;" note="{{$hydration->note}}">
                                                            <i class="fa-regular fa-comments"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('hydration.edit', ['id' => $hydration->id])}}" title="{{ __('actions.edit') }} {{ __('domains.hydration') }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{ $hydrations->onEachSide(1)->links() }}

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('fields.hydration.note') }}</h5>
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
