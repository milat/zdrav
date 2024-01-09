@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>{{ __('domains.user_preferences') }}</b>
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

                        <form method="POST" action="{{route('user_preference.update')}}">

                            @csrf
                            @method('patch')

                            <div class="form-group mt-2">
                                <label for="weight_unit_id" class="form-label">{{ __('fields.user_preference.weight_unit') }}</label>
                                <select name="weight_unit_id" id="weight_unit_id" class="form-select">
                                    @foreach ($weight_units as $weight_unit)
                                        <option value="{{$weight_unit->id}}" @if($weight_unit->id == Auth::user()->preferences->weightUnit->id) selected @endif>
                                            {{ __('seeded.'.$weight_unit->description) }} ({{$weight_unit->abbreviation}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="measurement_unit_id" class="form-label">{{ __('fields.user_preference.measurement_unit') }}</label>
                                <select name="measurement_unit_id" id="measurement_unit_id" class="form-select">
                                    @foreach ($measurement_units as $measurement_unit)
                                        <option value="{{$measurement_unit->id}}" @if($measurement_unit->id == Auth::user()->preferences->measurementUnit->id) selected @endif>
                                            {{ __('seeded.'.$measurement_unit->description) }} ({{$measurement_unit->abbreviation}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="hydration_unit_id" class="form-label">{{ __('fields.user_preference.hydration_unit') }}</label>
                                <select name="hydration_unit_id" id="hydration_unit_id" class="form-select">
                                    @foreach ($hydration_units as $hydration_unit)
                                        <option value="{{$hydration_unit->id}}" @if($hydration_unit->id == Auth::user()->preferences->hydrationUnit->id) selected @endif>
                                            {{ __('seeded.'.$hydration_unit->description) }} ({{$hydration_unit->abbreviation}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="language_id" class="form-label">{{ __('fields.user_preference.language') }}</label>
                                <select name="language_id" id="language_id" class="form-select">
                                    @foreach ($languages as $language)
                                        <option value="{{$language->id}}" @if($language->id == Auth::user()->preferences->language->id) selected @endif>
                                            {{ __('seeded.'.$language->description) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date_format_id" class="form-label">{{ __('fields.user_preference.date_format') }}</label>
                                <select name="date_format_id" id="date_format_id" class="form-select">
                                    @foreach ($date_formats as $date_format)
                                        <option value="{{$date_format->id}}" @if($date_format->id == Auth::user()->preferences->dateFormat->id) selected @endif>
                                            {{ __('seeded.'.$date_format->description) }}
                                        </option>
                                    @endforeach
                                </select>
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
