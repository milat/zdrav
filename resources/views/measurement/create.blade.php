@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>
                            @if (isset($measurement))
                                {{ __('actions.edit') }}
                            @else
                                {{ __('actions.create') }}
                            @endif
                            {{ __('domains.measurement') }}
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

                        <form method="POST" action="{{isset($measurement)?route('measurement.update', ['id' => $measurement->id]):route('measurement.store')}}">

                            @csrf
                            @if(isset($measurement))
                                @method('patch')
                            @endif

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.neck') }}</label>
                                <div class="input-group">
                                    <input type="number" name="neck" class="form-control float-input" id="neck" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->neck):old('neck')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.left_biceps') }}</label>
                                <div class="input-group">
                                    <input type="number" name="left_biceps" class="form-control float-input" id="left_biceps" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->left_biceps):old('left_biceps')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.right_biceps') }}</label>
                                <div class="input-group">
                                    <input type="number" name="right_biceps" class="form-control float-input" id="right_biceps" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->right_biceps):old('right_biceps')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.left_forearm') }}</label>
                                <div class="input-group">
                                    <input type="number" name="left_forearm" class="form-control float-input" id="left_forearm" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->left_forearm):old('left_forearm')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.right_forearm') }}</label>
                                <div class="input-group">
                                    <input type="number" name="right_forearm" class="form-control float-input" id="right_forearm" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->right_forearm):old('right_forearm')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.chest_bust') }}</label>
                                <div class="input-group">
                                    <input type="number" name="chest_bust" class="form-control float-input" id="chest_bust" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->chest_bust):old('chest_bust')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.abdomen') }}</label>
                                <div class="input-group">
                                    <input type="number" name="abdomen" class="form-control float-input" id="abdomen" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->abdomen):old('abdomen')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.waist') }}</label>
                                <div class="input-group">
                                    <input type="number" name="waist" class="form-control float-input" id="waist" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->waist):old('waist')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.hips') }}</label>
                                <div class="input-group">
                                    <input type="number" name="hips" class="form-control float-input" id="hips" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->hips):old('hips')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.left_thigh') }}</label>
                                <div class="input-group">
                                    <input type="number" name="left_thigh" class="form-control float-input" id="left_thigh" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->left_thigh):old('left_thigh')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.right_thigh') }}</label>
                                <div class="input-group">
                                    <input type="number" name="right_thigh" class="form-control float-input" id="right_thigh" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->right_thigh):old('right_thigh')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.left_calf') }}</label>
                                <div class="input-group">
                                    <input type="number" name="left_calf" class="form-control float-input" id="left_calf" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->left_calf):old('left_calf')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.right_calf') }}</label>
                                <div class="input-group">
                                    <input type="number" name="right_calf" class="form-control float-input" id="right_calf" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->right_calf):old('right_calf')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.left_ankle') }}</label>
                                <div class="input-group">
                                    <input type="number" name="left_ankle" class="form-control float-input" id="left_ankle" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->left_ankle):old('left_ankle')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.measurement.right_ankle') }}</label>
                                <div class="input-group">
                                    <input type="number" name="right_ankle" class="form-control float-input" id="right_ankle" placeholder="" value="{{isset($measurement)?\App\Helpers\NumberHelper::toFloat($measurement->right_ankle):old('right_ankle')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{Auth::user()->preferences->measurementUnit->abbreviation}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label>{{ __('messages.feeling') }}</label>
                                <div class="rating">
                                    @foreach($scores as $score)
                                        <input type="radio" name="score_id" value="{{$score->id}}" id="{{$score->id}}" {{((isset($measurement)&&$score->id==$measurement->score->id)or(old('score_id')==$score->id))?'checked':''}}>
                                        <label for="{{$score->id}}" title="{{ __('seeded.'.$score->description)}}">☆</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date_time">{{ __('fields.measurement.date') }}</label>
                                <input type="date" name="date" class="form-control" id="date" value="{{isset($measurement)?$measurement->date:date('Y-m-d')}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="note">{{ __('fields.measurement.note') }}</label>
                                <textarea name="note" class="form-control" id="note">{{isset($measurement)?$measurement->note:old('note')}}</textarea>
                            </div>

                            <div class="text-center">
                                <a href="{{route('measurement.view')}}" class="btn btn-outline-secondary mt-3">{{ __('actions.cancel') }}</a>
                                <button type="submit" class="btn btn-primary mt-3">{{ __('actions.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($measurement))
                    <div class="text-center col-md-2 offset-md-5 col-sm-4 offset-sm-4 mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-block btn-sm btn-outline-danger text-center" id="modal" data-toggle="modal" data-target="#modal-content">
                            {{ __('actions.destroy') }} {{ __('domains.measurement') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            {{ __('actions.destroy') }} {{ __('domains.measurement') }}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('messages.sureness') }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel-model" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
                                        <form method="POST" action="{{route('measurement.destroy', ['id' => $measurement->id])}}">
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
