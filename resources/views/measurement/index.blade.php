@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <b>{{ __('domains.measurement') }}</b>
                        <a href="{{route('measurement.create')}}" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-circle"></i> {{ __('actions.create') }}</a>
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
                                            <th scope="col" class="text-center">{{ __('fields.measurement.date') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.measurement.score') }}</th>
                                            <th scope="col" class="text-center">{{ __('fields.measurement.measurements') }} / {{ __('fields.measurement.note') }}</th>
                                            <th scope="col" class="text-center">{{ __('actions.edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($measurements as $measurement)
                                            <tr>
                                                <th scope="row" class="text-center" style= "white-space: nowrap;">{{\App\Helpers\DateHelper::convertFormat($measurement->date)}}</th>
                                                <td class="text-center" style="white-space: nowrap;">
                                                    @for($i = 1; $i <= $measurement->score->value; $i++)
                                                        <i style="color: #ffc107" class="bi bi-star-fill"></i>
                                                    @endfor
                                                    @for($i = 1; $i <= 5 - $measurement->score->value; $i++)
                                                        <i style="color: #ffe69c" class="bi bi-star"></i>
                                                    @endfor
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                    $measurementsList = "";
                                                    if ($measurement->neck) {
                                                        $measurementsList .= "<b>".__('fields.measurement.neck')."</b>: ".$measurement->neck." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->left_biceps) {
                                                        $measurementsList .= "<b>".__('fields.measurement.left_biceps')."</b>: ".$measurement->left_biceps." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->right_biceps) {
                                                        $measurementsList .= "<b>".__('fields.measurement.right_biceps')."</b>: ".$measurement->right_biceps." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->left_forearm) {
                                                        $measurementsList .= "<b>".__('fields.measurement.left_forearm')."</b>: ".$measurement->left_forearm." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->right_forearm) {
                                                        $measurementsList .= "<b>".__('fields.measurement.right_forearm')."</b>: ".$measurement->right_forearm." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->chest_bust) {
                                                        $measurementsList .= "<b>".__('fields.measurement.chest_bust')."</b>: ".$measurement->chest_bust." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->abdomen) {
                                                        $measurementsList .= "<b>".__('fields.measurement.abdomen')."</b>: ".$measurement->abdomen." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->waist) {
                                                        $measurementsList .= "<b>".__('fields.measurement.waist')."</b>: ".$measurement->waist." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->hips) {
                                                        $measurementsList .= "<b>".__('fields.measurement.hips')."</b>: ".$measurement->hips." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->left_thigh) {
                                                        $measurementsList .= "<b>".__('fields.measurement.left_thigh')."</b>: ".$measurement->left_thigh." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->right_thigh) {
                                                        $measurementsList .= "<b>".__('fields.measurement.right_thigh')."</b>: ".$measurement->right_thigh." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->left_calf) {
                                                        $measurementsList .= "<b>".__('fields.measurement.left_calf')."</b>: ".$measurement->left_calf." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->right_calf) {
                                                        $measurementsList .= "<b>".__('fields.measurement.right_calf')."</b>: ".$measurement->right_calf." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->left_ankle) {
                                                        $measurementsList .= "<b>".__('fields.measurement.left_ankle')."</b>: ".$measurement->left_ankle." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->right_ankle) {
                                                        $measurementsList .= "<b>".__('fields.measurement.right_ankle')."</b>: ".$measurement->right_ankle." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    if ($measurement->note) {
                                                        $measurementsList .= "<hr /><b>".__('fields.measurement.note')."</b>: ".$measurement->note." ".$measurement->unit->abbreviation."<br />";
                                                    }
                                                    @endphp
                                                    <a class="modal-trigger" href="javascript:;" note="{{$measurementsList}}">
                                                        <i class="bi bi-card-text"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('measurement.edit', ['id' => $measurement->id])}}" title="{{ __('actions.edit') }} {{ __('domains.measurement') }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{ $measurements->onEachSide(1)->links() }}

                        <!-- Modal -->
                        <div class="modal fade" id="modal-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('fields.measurement.measurements') }} / {{ __('fields.measurement.note') }}</h5>
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
