@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>
                            @if (isset($training))
                                {{ __('actions.edit') }}
                            @else
                                {{ __('actions.create') }}
                            @endif
                            {{ __('domains.training') }}
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

                        <form method="POST" action="{{isset($training)?route('training.update', ['id' => $training->id]):route('training.store')}}">

                            @csrf
                            @if(isset($training))
                                @method('patch')
                            @endif

                            <div class="form-group mt-2">
                                <label for="training_category_id" class="form-label">{{ __('fields.training.training_category') }}</label>
                                <select name="training_category_id" id="training_category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{((isset($training)&&$category->id==$training->category->id)or(old('training_category_id')==$category->id))?'selected':''}}>
                                            {{$category->description}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.training.length') }}</label>
                                <div class="input-group">
                                    <input type="text" name="length" class="form-control" id="length" placeholder="" value="{{isset($training)?$training->length:old('length')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{ __('fields.training.unit') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label>{{ __('messages.feeling') }}</label>
                                <div class="rating">
                                    @foreach($scores as $score)
                                        <input type="radio" name="score_id" value="{{$score->id}}" id="{{$score->id}}" {{((isset($training)&&$score->id==$training->score->id)or(old('score_id')==$score->id))?'checked':''}}>
                                        <label for="{{$score->id}}" title="{{ __('seeded.'.$score->description)}}">☆</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date">{{ __('fields.training.date_time') }}</label>
                                <input type="datetime-local" name="date_time" class="form-control" id="date_time" value="{{isset($training)?$training->date_time:date('Y-m-d H:i:s')}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="note">{{ __('fields.training.note') }}</label>
                                <textarea name="note" class="form-control" id="note">{{isset($training)?$training->note:""}}</textarea>
                            </div>

                            <div class="text-center">
                                <a href="{{route('training.view')}}" class="btn btn-outline-secondary mt-3">{{ __('actions.cancel') }}</a>
                                <button type="submit" class="btn btn-primary mt-3">{{ __('actions.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($training))
                    <div class="text-center col-md-2 offset-md-5 col-sm-4 offset-sm-4 mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-block btn-sm btn-outline-danger text-center" id="modal" data-toggle="modal" data-target="#modal-content">
                            {{ __('actions.destroy') }} {{ __('domains.training') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            {{ __('actions.destroy') }} {{ __('domains.training') }}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('messages.sureness') }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel-model" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
                                        <form method="POST" action="{{route('training.destroy', ['id' => $training->id])}}">
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
