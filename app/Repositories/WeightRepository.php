<?php

namespace App\Repositories;

use App\Http\Requests\WeightRequest;
use App\Models\Weight;
use Illuminate\Support\Facades\Auth;

class WeightRepository extends Repository
{
    public static function find(int $id)
    {
        $weight = Weight::find($id);
        self::validateOwner($weight);
        return $weight;
    }

    public static function get()
    {
        return Weight::where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public static function store(WeightRequest $request)
    {
        return Weight::create([
            'user_id' => Auth::user()->id,
            'weight_unit_id' => Auth::user()->preferences->weightUnit->id,
            'score_id' => $request->score_id,
            'value' => $request->value,
            'date' => $request->date,
            'note' => $request->note
        ]);
    }

    public static function update(WeightRequest $request, int $id)
    {
        $weight = self::find($id);

        $weight->weight_unit_id = Auth::user()->preferences->weightUnit->id;
        $weight->score_id = $request->score_id;
        $weight->value = $request->value;
        $weight->date = $request->date;
        $weight->note = $request->note;

        $weight->save();
    }

    public static function destroy(int $id)
    {
        self::find($id);
        return Weight::destroy($id);
    }
}
