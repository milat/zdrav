<?php

namespace App\Repositories;

use App\Exceptions\DeleteWithRelationshipException;
use App\Http\Requests\TrainingCategoryRequest;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Auth;

class TrainingCategoryRepository extends Repository
{
    public static function find(int $id)
    {
        $trainingCategory = TrainingCategory::find($id);
        self::validateOwner($trainingCategory);
        return $trainingCategory;
    }

    public static function get(bool $onlyActive = false, bool $paginate = true)
    {
        $query = TrainingCategory::where('user_id', Auth::user()->id);

        if ($onlyActive) {
            $query->where('is_active', true);
        }

        $query->orderBy('is_active', 'desc')
            ->orderBy('description');

        if ($paginate) {
            return $query->paginate(self::PER_PAGE);
        }

        return $query->get();
    }

    public static function store(TrainingCategoryRequest $request)
    {
        return TrainingCategory::create([
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'is_active' => (bool)$request->is_active
        ]);
    }

    public static function update(TrainingCategoryRequest $request, int $id)
    {
        $trainingCategory = self::find($id);

        $trainingCategory->description = $request->description;
        $trainingCategory->is_active = (bool)$request->is_active;

        return $trainingCategory->save();
    }

    /**
     * @throws DeleteWithRelationshipException
     */
    public static function destroy(int $id)
    {
        $trainingCategory = self::find($id);

        if ($trainingCategory->trainings->isNotEmpty()) {
            throw new DeleteWithRelationshipException(__('messages.destroy_training_category_relationship_error'));
        }

        return TrainingCategory::destroy($id);
    }
}
