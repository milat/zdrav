<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\MealRequest;
use App\Repositories\MealRepository;
use App\Repositories\MealTypeRepository;
use App\Repositories\ScoreRepository;

class MealController extends Controller
{
    public function view(): View
    {
        return view('meal.index')->with([
            'meals' => MealRepository::get()
        ]);
    }

    public function create()
    {
        return view('meal.create')->with([
            'mealTypes' => MealTypeRepository::get(),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function store(MealRequest $request)
    {
        try {
            MealRepository::store($request);
            return $this->returnViewWithSuccessMessage('meal.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function edit(int $id)
    {
        return view('meal.create')->with([
            'meal' => MealRepository::find($id),
            'mealTypes' => MealTypeRepository::get(),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function update(MealRequest $request, int $id)
    {
        try {
            MealRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('meal.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function destroy(int $id)
    {
        try {
            MealRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('meal.view', __('messages.destroy_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
