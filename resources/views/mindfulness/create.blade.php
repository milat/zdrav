@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>
                            @if (isset($mindfulness))
                                {{ __('actions.edit') }}
                            @else
                                {{ __('actions.create') }}
                            @endif
                            {{ __('domains.mindfulness') }}
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

                        <form method="POST" action="{{isset($mindfulness)?route('mindfulness.update', ['id' => $mindfulness->id]):route('mindfulness.store')}}">

                            @csrf
                            @if(isset($mindfulness))
                                @method('patch')
                            @endif

                            <div class="form-group mt-2">
                                <label for="value">{{ __('fields.mindfulness.length') }}</label>
                                <div class="input-group">
                                    <input type="text" name="length" class="form-control" id="length" placeholder="" value="{{isset($mindfulness)?$mindfulness->length:old('length')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{ __('fields.mindfulness.unit') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label>{{ __('messages.feeling') }}</label>
                                <div class="rating">
                                    @foreach($scores as $score)
                                        <input type="radio" name="score_id" value="{{$score->id}}" id="{{$score->id}}" {{((isset($mindfulness)&&$score->id==$mindfulness->score->id)or(old('score_id')==$score->id))?'checked':''}}>
                                        <label for="{{$score->id}}" title="{{ __('seeded.'.$score->description)}}">☆</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date">{{ __('fields.mindfulness.date_time') }}</label>
                                <input type="datetime-local" name="date_time" class="form-control" id="date_time" value="{{isset($mindfulness)?$mindfulness->date_time:date('Y-m-d H:i:s')}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="note">{{ __('fields.mindfulness.note') }}</label>
                                <textarea name="note" class="form-control" id="note">{{isset($mindfulness)?$mindfulness->note:""}}</textarea>
                            </div>

                            <div class="text-center">
                                <a href="{{route('mindfulness.view')}}" class="btn btn-outline-secondary mt-3">{{ __('actions.cancel') }}</a>
                                <button type="submit" class="btn btn-primary mt-3">{{ __('actions.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($mindfulness))
                    <div class="text-center col-md-2 offset-md-5 col-sm-4 offset-sm-4 mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-block btn-sm btn-outline-danger text-center" id="modal" data-toggle="modal" data-target="#modal-content">
                            {{ __('actions.destroy') }} {{ __('domains.mindfulness') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            {{ __('actions.destroy') }} {{ __('domains.mindfulness') }}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('messages.sureness') }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel-model" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
                                        <form method="POST" action="{{route('mindfulness.destroy', ['id' => $mindfulness->id])}}">
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
