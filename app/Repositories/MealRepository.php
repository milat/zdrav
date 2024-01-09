<?php

namespace App\Repositories;

use App\Models\Meal;
use App\Http\Requests\MealRequest;
use Illuminate\Support\Facades\Auth;

class MealRepository extends Repository
{
    public static function find(int $id)
    {
        $meal = Meal::find($id);
        self::validateOwner($meal);
        return $meal;
    }

    public static function get()
    {
        return Meal::where('user_id', Auth::user()->id)
            ->orderBy('date_time', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public static function store(MealRequest $request)
    {
        return Meal::create([
            'user_id' => Auth::user()->id,
            'meal_type_id' => $request->meal_type_id,
            'score_id' => $request->score_id,
            'date_time' => $request->date_time,
            'note' => $request->note
        ]);
    }

    public static function update(MealRequest $request, int $id)
    {
        $meal = self::find($id);

        $meal->meal_type_id = $request->meal_type_id;
        $meal->score_id = $request->score_id;
        $meal->date_time = $request->date_time;
        $meal->note = $request->note;

        return $meal->save();
    }

    public static function destroy(int $id)
    {
        self::find($id);
        return Meal::destroy($id);
    }
}
