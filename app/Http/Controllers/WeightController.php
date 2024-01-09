<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightRequest;
use App\Repositories\ScoreRepository;
use App\Repositories\WeightRepository;
use Illuminate\View\View;

class WeightController extends Controller
{
    public function view(): View
    {
        return view('weight.index')->with([
            'weights' => WeightRepository::get()
        ]);
    }

    public function create()
    {
        return view('weight.create')->with([
            'scores' => ScoreRepository::get()
        ]);
    }

    public function store(WeightRequest $request)
    {
        try {
            WeightRepository::store($request);
            return $this->returnViewWithSuccessMessage('weight.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function edit(int $id)
    {
        return view('weight.create')->with([
            'weight' => WeightRepository::find($id),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function update(WeightRequest $request, int $id)
    {
        try {
            WeightRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('weight.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function destroy(int $id)
    {
        try {
            WeightRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('weight.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
