<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasurementRequest;
use App\Repositories\MeasurementRepository;
use Illuminate\View\View;
use App\Repositories\ScoreRepository;

class MeasurementController extends Controller
{
    public function view(): View
    {
        return view('measurement.index')->with([
            'measurements' => MeasurementRepository::get()
        ]);
    }

    public function create()
    {
        return view('measurement.create')->with([
            'scores' => ScoreRepository::get()
        ]);
    }

    public function store(MeasurementRequest $request)
    {
        try {
            MeasurementRepository::store($request);
            return $this->returnViewWithSuccessMessage('measurement.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e, true);
        }
    }

    public function edit(int $id)
    {
        return view('measurement.create')->with([
            'measurement' => MeasurementRepository::find($id),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function update(MeasurementRequest $request, int $id)
    {
        try {
            MeasurementRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('measurement.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function destroy(int $id)
    {
        try {
            MeasurementRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('measurement.view', __('messages.destroy_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
