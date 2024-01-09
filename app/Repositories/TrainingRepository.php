<?php

namespace App\Repositories;

use App\Http\Requests\TrainingRequest;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;

class TrainingRepository extends Repository
{
    public static function find(int $id)
    {
        $training = Training::find($id);
        self::validateOwner($training);
        return $training;
    }

    public static function get(int $category_id = null)
    {
        $query = Training::where('user_id', Auth::user()->id);

        if ($category_id) {
            $query->where('training_category_id', $category_id);
        }

        return $query->orderBy('date_time', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public static function store(TrainingRequest $request)
    {
        return Training::create([
            'user_id' => Auth::user()->id,
            'training_category_id' => $request->training_category_id,
            'score_id' => $request->score_id,
            'length' => $request->length,
            'date_time' => $request->date_time,
            'note' => $request->note
        ]);
    }

    public static function update(TrainingRequest $request, int $id)
    {
        $training = self::find($id);

        $training->training_category_id = $request->training_category_id;
        $training->score_id = $request->score_id;
        $training->length = $request->length;
        $training->date_time = $request->date_time;
        $training->note = $request->note;

        return $training->save();
    }

    public static function destroy(int $id)
    {
        self::find($id);
        return Training::destroy($id);
    }
}
