<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingRequest;
use App\Repositories\TrainingCategoryRepository;
use App\Repositories\TrainingRepository;
use Illuminate\View\View;
use App\Repositories\ScoreRepository;
use Symfony\Component\HttpFoundation\Request;

class TrainingController extends Controller
{
    public function view(Request $request): View
    {
        return view('training.index')->with([
            'trainings' => TrainingRepository::get($request->filter)
        ]);
    }

    public function create()
    {
        return view('training.create')->with([
            'categories' => TrainingCategoryRepository::get(true),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function store(TrainingRequest $request)
    {
        try {
            TrainingRepository::store($request);
            return $this->returnViewWithSuccessMessage('training.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function edit(int $id)
    {
        return view('training.create')->with([
            'training' => TrainingRepository::find($id),
            'categories' => TrainingCategoryRepository::get(true),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function update(TrainingRequest $request, int $id)
    {
        try {
            TrainingRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('training.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function destroy(int $id)
    {
        try {
            TrainingRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('training.view', __('messages.destroy_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
