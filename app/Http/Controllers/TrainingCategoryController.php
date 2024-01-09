<?php

namespace App\Http\Controllers;

use App\Exceptions\DeleteWithRelationshipException;
use App\Http\Requests\TrainingCategoryRequest;
use App\Repositories\TrainingCategoryRepository;
use Illuminate\View\View;

class TrainingCategoryController extends Controller
{
    public function all()
    {
        return TrainingCategoryRepository::get(false, false);
    }

    public function view(): View
    {
        return view('training_category.index')->with([
            'training_categories' => TrainingCategoryRepository::get()
        ]);
    }

    public function create()
    {
        return view('training_category.create');
    }

    public function store(TrainingCategoryRequest $request)
    {
        try {
            TrainingCategoryRepository::store($request);
            return $this->returnViewWithSuccessMessage('training_category.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function edit(int $id)
    {
        return view('training_category.create')->with([
            'training_category' => TrainingCategoryRepository::find($id)
        ]);
    }

    public function update(TrainingCategoryRequest $request, int $id)
    {
        try {
            TrainingCategoryRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('training_category.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e, true);
        }
    }

    public function destroy(int $id)
    {
        try {
            TrainingCategoryRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('training_category.view', __('messages.destroy_success'));
        } catch (DeleteWithRelationshipException $e) {
            return $this->returnBackWithError($e, true);
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
