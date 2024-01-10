@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <b>{{ __('domains.test') }}</b>
                        <a href="{{route('test.create')}}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-plus"></i> {{ __('actions.create') }}</a>
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
                                            <th scope="col" class="text-center">{{ __('fields.test.date') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.test.description') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.test.value') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.test.test_reference') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.test.note') }}</th>
                                            <th scope="col" class="text-center">{{ __('actions.edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tests as $test)
                                            <tr>
                                                <td class="text-center">{{\App\Helpers\DateHelper::convertFormat($test->date)}}</td>
                                                <th scope="row" class="text-center" style= "white-space: nowrap;">{{$test->description}}</th>
                                                <td class="text-center">{{$test->value}} {{$test->unit}}</td>
                                                <td class="text-center">
                                                    @if ($test->reference->icon)
                                                        <i style="color: {{$test->reference->color}};" class="fa-solid fa-{{$test->reference->icon}}"></i>
                                                    @endif
                                                    {{ __('seeded.'.$test->reference->description) }}
                                                </td>
                                                <td class="text-center">
                                                    @if($test->note)
                                                        <a class="modal-trigger" href="javascript:;" note="{{$test->note}}">
                                                            <i class="fa-regular fa-comments"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('test.edit', ['id' => $test->id])}}" title="{{ __('actions.edit') }} {{ __('domains.test') }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{ $tests->onEachSide(1)->appends(['filter' => Request::get('filter')])->links() }}

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('fields.test.note') }}</h5>
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

            $.get('{{route('test.filter')}}', function (data) {
                $('#filter').append('<option value="null">{{ __('filters.all_tests') }}</option>');
                $.each(data, function(k, v) {
                    let selected = '';
                    if (v.description == '{{Request::get('filter')}}'){
                        selected = 'selected'
                    }
                    $('#filter').append('<option value="'+v.description+'" '+selected+'>'+v.description+'</option>');
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
            window.location.href = '{{ route('test.view') }}'+url;
        })
    </script>
@endsection
