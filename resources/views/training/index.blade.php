@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <b>{{ __('domains.training') }}</b>
                        <div>
                            <a href="{{route('training_category.view')}}" class="btn btn-outline-secondary btn-sm">{{ __('domains.training_category') }}</a>
                            <a href="{{route('training.create')}}" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('actions.create') }}</a>
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
                            <div class="col-md-4 d-flex justify-content-center">
                                <img id="loading" src="{{ url('storage/images/loading.gif') }}" alt="" title="" width="30px" />
                                <select name="filter" id="filter" class="form-select"></select>
                            </div>
                        </div>

                        <hr />

                        <div class="row">
                            <div class="col-12 table-responsive-md">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">{{ __('fields.training.date_time') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.training.training_category') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.training.length') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.training.score') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.training.note') }}</th>
                                            <th scope="col" class="text-center">{{ __('actions.edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trainings as $training)
                                            <tr>
                                                <td class="text-center">{{\App\Helpers\DateHelper::convertFormat($training->date_time, true)}}</td>
                                                <th scope="row" class="text-center" style= "white-space: nowrap;">{{$training->category->description}}</th>
                                                <td class="text-center">@if ($training->length) {{$training->length}} {{ __('fields.training.unit') }} @else - @endif</td>
                                                <td class="text-center" style="white-space: nowrap;">
                                                    @for($i = 1; $i <= $training->score->value; $i++)
                                                        <i style="color: #ffc107" class="bi bi-star-fill"></i>
                                                    @endfor
                                                    @for($i = 1; $i <= 5 - $training->score->value; $i++)
                                                        <i style="color: #ffe69c" class="bi bi-star"></i>
                                                    @endfor
                                                </td>
                                                <td class="text-center">
                                                    @if($training->note)
                                                        <a class="modal-trigger" href="javascript:;" note="{{$training->note}}">
                                                            <i class="bi bi-card-text"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('training.edit', ['id' => $training->id])}}" title="{{ __('actions.edit') }} {{ __('domains.training') }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{ $trainings->onEachSide(1)->appends(['filter' => Request::get('filter')])->links() }}

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('fields.training.note') }}</h5>
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
        $(document).ready(function () {
            $('#filter').hide();
            $('#loading').show();

            $.get('{{route('training_category.all')}}', function (data) {
                $('#filter').append('<option value="null">{{ __('filters.all_training_categories') }}</option>');
                $.each(data, function(k, v) {
                    let selected = '';
                    if (v.id == '{{Request::get('filter')}}'){
                        selected = 'selected'
                    }
                    $('#filter').append('<option value="'+v.id+'" '+selected+'>'+v.description+'</option>');
                });
            });
            $('#loading').hide();
            $('#filter').show();
        });

        $('.modal-trigger').on('click' , function(e) {
            e.preventDefault();
            $('.modal-body').html($(this).attr('note'));
            $('#modal-content').modal('show');
        });

        $('#cancel-model').on('click', function(e) {
            e.preventDefault();
            $('#modal-content').modal('hide');
        });

        $('#filter').on('change', function(e) {
            e.preventDefault();
            let value = $(this).val();
            let url = '';
            if (value != 'null') {
                url = '?filter='+value;
            }
            window.location.href = '{{ route('training.view') }}'+url;
        })
    </script>
@endsection
