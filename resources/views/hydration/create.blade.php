@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>
                            @if (isset($hydration))
                                {{ __('actions.edit') }}
                            @else
                                {{ __('actions.create') }}
                            @endif
                            {{ __('domains.hydration') }}
                        </b>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{isset($hydration)?route('hydration.update', ['id' => $hydration->id]):route('hydration.store')}}">

                            @csrf
                            @if(isset($hydration))
                                @method('patch')
                            @endif

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.hydration.amount') }}</label>
                                <div class="input-group">
                                    <input type="number" name="amount" class="form-control" id="amount" placeholder="" value="{{isset($hydration)?$hydration->amount:old('amount')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->hydrationUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label>{{ __('messages.feeling') }}</label>
                                <div class="rating">
                                    @foreach($scores as $score)
                                        <input type="radio" name="score_id" value="{{$score->id}}" id="{{$score->id}}" {{((isset($hydration)&&$score->id==$hydration->score->id)or(old('score_id')==$score->id))?'checked':''}}>
                                        <label for="{{$score->id}}" title="{{ __('seeded.'.$score->description)}}">☆</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date">{{ __('fields.hydration.date') }}</label>
                                <input type="date" name="date" class="form-control" id="date" value="{{isset($hydration)?$hydration->date:date('Y-m-d')}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="note">{{ __('fields.hydration.note') }}</label>
                                <textarea name="note" class="form-control" id="note">{{isset($hydration)?$hydration->note:""}}</textarea>
                            </div>

                            <div class="text-center">
                                <a href="{{route('hydration.view')}}" class="btn btn-outline-secondary mt-3">{{ __('actions.cancel') }}</a>
                                <button type="submit" class="btn btn-primary mt-3">{{ __('actions.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($hydration))
                    <div class="text-center col-md-2 offset-md-5 col-sm-4 offset-sm-4 mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-block btn-sm btn-outline-danger text-center" id="modal" data-toggle="modal" data-target="#modal-content">
                            {{ __('actions.destroy') }} {{ __('domains.hydration') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            {{ __('actions.destroy') }} {{ __('domains.hydration') }}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('messages.sureness') }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel-model" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
                                        <form method="POST" action="{{route('hydration.destroy', ['id' => $hydration->id])}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-outline-danger">{{ __('actions.destroy') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $('#modal').on('click' , function(e){
            e.preventDefault();
            $('#modal-content').modal('show');
        });

        $('#cancel-model').on('click', function(e){
            e.preventDefault();
            $('#modal-content').modal('hide');
        });
    </script>
@endsection
