<?php

namespace App\Repositories;

use App\Models\Mindfulness;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MindfulnessRequest;

class MindfulnessRepository extends Repository
{
    public static function find(int $id)
    {
        $mindfulness = Mindfulness::find($id);
        self::validateOwner($mindfulness);
        return $mindfulness;
    }

    public static function get()
    {
        return Mindfulness::where('user_id', Auth::user()->id)
            ->orderBy('date_time', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public static function store(MindfulnessRequest $request)
    {
        return Mindfulness::create([
            'user_id' => Auth::user()->id,
            'length' => $request->length,
            'score_id' => $request->score_id,
            'date_time' => $request->date_time,
            'note' => $request->note
        ]);
    }

    public static function update(MindfulnessRequest $request, int $id)
    {
        $mindfulness = self::find($id);

        $mindfulness->score_id = $request->score_id;
        $mindfulness->length = $request->length;
        $mindfulness->date_time = $request->date_time;
        $mindfulness->note = $request->note;

        return $mindfulness->save();
    }

    public static function destroy(int $id)
    {
        self::find($id);
        return Mindfulness::destroy($id);
    }
}
