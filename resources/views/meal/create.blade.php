@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>
                            @if (isset($meal))
                                {{ __('actions.edit') }}
                            @else
                                {{ __('actions.create') }}
                            @endif
                            {{ __('domains.meal') }}
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

                        <form method="POST" action="{{isset($meal)?route('meal.update', ['id' => $meal->id]):route('meal.store')}}">

                            @csrf
                            @if(isset($meal))
                                @method('patch')
                            @endif

                            <div class="form-group mt-2">
                                <label for="meal_type_id" class="form-label">{{ __('fields.meal.type') }}</label>
                                <select name="meal_type_id" id="meal_type_id" class="form-select">
                                    @foreach ($mealTypes as $mealType)
                                        <option value="{{$mealType->id}}" @if((isset($meal) && $meal->type->id == $mealType->id) or old('meal_type_id') == $mealType->id) selected @endif>
                                            {{ __('seeded.'.$mealType->description) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label>{{ __('messages.feeling') }}</label>
                                <div class="rating">
                                    @foreach($scores as $score)
                                        <input type="radio" name="score_id" value="{{$score->id}}" id="{{$score->id}}" {{((isset($meal)&&$score->id==$meal->score->id)or(old('score_id')==$score->id))?'checked':''}}>
                                        <label for="{{$score->id}}" title="{{ __('seeded.'.$score->description)}}">☆</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date_time">{{ __('fields.meal.date_time') }}</label>
                                <input type="datetime-local" name="date_time" class="form-control" id="date_time" value="{{isset($meal)?$meal->date_time:date('Y-m-d H:i:s')}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="note">{{ __('fields.meal.note') }}</label>
                                <textarea name="note" class="form-control" id="note">{{isset($meal)?$meal->note:""}}</textarea>
                            </div>

                            <div class="text-center">
                                <a href="{{route('meal.view')}}" class="btn btn-outline-secondary mt-3">{{ __('actions.cancel') }}</a>
                                <button type="submit" class="btn btn-primary mt-3">{{ __('actions.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($meal))
                    <div class="text-center col-md-2 offset-md-5 col-sm-4 offset-sm-4 mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-block btn-sm btn-outline-danger text-center" id="modal" data-toggle="modal" data-target="#modal-content">
                            {{ __('actions.destroy') }} {{ __('domains.meal') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            {{ __('actions.destroy') }} {{ __('domains.meal') }}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('messages.sureness') }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel-model" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
                                        <form method="POST" action="{{route('meal.destroy', ['id' => $meal->id])}}">
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
