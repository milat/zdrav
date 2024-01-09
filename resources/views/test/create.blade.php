@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-md-4 offset-md-4">
                    <div class="card-header">
                        <b>
                            @if (isset($test))
                                {{ __('actions.edit') }}
                            @else
                                {{ __('actions.create') }}
                            @endif
                            {{ __('domains.test') }}
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

                        <form method="POST" action="{{isset($test)?route('test.update', ['id' => $test->id]):route('test.store')}}">

                            @csrf
                            @if(isset($test))
                                @method('patch')
                            @endif

                            <div class="form-group mt-2">
                                <label for="date">{{ __('fields.test.description') }}</label>
                                <input type="text" name="description" list="descriptionSuggestions" autocomplete="off" class="form-control" id="description" value="{{isset($test)?$test->description:old('description')}}">
                                <datalist id="descriptionSuggestions">
                                    @foreach ($descriptionSuggestions as $suggest)
                                        <option value="{{$suggest->description}}">{{$suggest->description}}</option>
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date">{{ __('fields.test.value') }}</label>
                                <input type="text" name="value" class="form-control float-input" id="value" value="{{isset($test)?$test->value:old('value')}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="date">{{ __('fields.test.unit') }}</label>
                                <input type="text" name="unit" list="unitSuggestions" class="form-control" autocomplete="off" id="unit" value="{{isset($test)?$test->unit:old('unit')}}">
                                <datalist id="unitSuggestions">
                                    @foreach ($unitSuggestions as $suggest)
                                        <option value="{{$suggest->unit}}">{{$suggest->unit}}</option>
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="form-group mt-2">
                                <label for="test_reference_id" class="form-label">{{ __('fields.test.test_reference') }}</label>
                                <select name="test_reference_id" id="test_reference_id" class="form-select">
                                    @foreach ($references as $reference)
                                        <option value="{{$reference->id}}" {{((isset($test)&&$reference->id==$test->reference->id)or(old('test_reference_id')==$reference->id))?'selected':''}}>
                                            {{ __('seeded.'.$reference->description) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="date">{{ __('fields.test.date') }}</label>
                                <input type="date" name="date" class="form-control" id="date" value="{{isset($test)?$test->date:date('Y-m-d')}}">
                            </div>

                            <div class="form-group mt-2">
                                <label for="note">{{ __('fields.test.note') }}</label>
                                <textarea name="note" class="form-control" id="note">{{isset($test)?$test->note:""}}</textarea>
                            </div>

                            <div class="text-center">
                                <a href="{{route('test.view')}}" class="btn btn-outline-secondary mt-3">{{ __('actions.cancel') }}</a>
                                <button type="submit" class="btn btn-primary mt-3">{{ __('actions.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($test))
                    <div class="text-center col-md-2 offset-md-5 col-sm-4 offset-sm-4 mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-block btn-sm btn-outline-danger text-center" id="modal" data-toggle="modal" data-target="#modal-content">
                            {{ __('actions.destroy') }} {{ __('domains.test') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            {{ __('actions.destroy') }} {{ __('domains.test') }}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('messages.sureness') }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel-model" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
                                        <form method="POST" action="{{route('test.destroy', ['id' => $test->id])}}">
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
