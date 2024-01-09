<?php

namespace App\Repositories;

use App\Http\Requests\HydrationRequest;
use App\Models\Hydration;
use Illuminate\Support\Facades\Auth;

class HydrationRepository extends Repository
{
    public static function find(int $id)
    {
        $hydration = Hydration::find($id);
        self::validateOwner($hydration);
        return $hydration;
    }

    public static function get()
    {
        return Hydration::where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public static function store(HydrationRequest $request)
    {
        return Hydration::create([
            'user_id' => Auth::user()->id,
            'hydration_unit_id' => Auth::user()->preferences->hydrationUnit->id,
            'amount' => $request->amount,
            'score_id' => $request->score_id,
            'date' => $request->date,
            'note' => $request->note
        ]);
    }

    public static function update(HydrationRequest $request, int $id)
    {
        $hydration = self::find($id);

        $hydration->hydration_unit_id = Auth::user()->preferences->hydrationUnit->id;
        $hydration->score_id = $request->score_id;
        $hydration->amount = $request->amount;
        $hydration->date = $request->date;
        $hydration->note = $request->note;

        return $hydration->save();
    }

    public static function destroy(int $id)
    {
        self::find($id);
        return Hydration::destroy($id);
    }
}
