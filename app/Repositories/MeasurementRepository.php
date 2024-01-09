<?php

namespace App\Repositories;

use App\Http\Requests\MeasurementRequest;
use App\Models\Measurement;
use Illuminate\Support\Facades\Auth;

class MeasurementRepository extends Repository
{
    public static function find(int $id)
    {
        $measurement = Measurement::find($id);
        self::validateOwner($measurement);
        return $measurement;
    }

    public static function get()
    {
        return Measurement::where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public static function store(MeasurementRequest $request)
    {
        return Measurement::create([
            'user_id' => Auth::user()->id,
            'measurement_unit_id' => Auth::user()->preferences->measurementUnit->id,
            'score_id' => $request->score_id,
            'neck' => $request->neck,
            'left_biceps' => $request->left_biceps,
            'right_biceps' => $request->right_biceps,
            'left_forearm' => $request->left_forearm,
            'right_forearm' => $request->right_forearm,
            'chest_bust' => $request->chest_bust,
            'abdomen' => $request->abdomen,
            'waist' => $request->waist,
            'hips' => $request->hips,
            'left_thigh' => $request->left_thigh,
            'right_thigh' => $request->right_thigh,
            'left_calf' => $request->left_calf,
            'right_calf' => $request->right_calf,
            'left_ankle' => $request->left_ankle,
            'right_ankle' => $request->right_ankle,
            'date' => $request->date,
            'note' => $request->note
        ]);
    }

    public static function update(MeasurementRequest $request, int $id)
    {
        $measurement = self::find($id);

        $measurement->measurement_unit_id = Auth::user()->preferences->measurementUnit->id;
        $measurement->score_id = $request->score_id;
        $measurement->neck = $request->neck;
        $measurement->left_biceps = $request->left_biceps;
        $measurement->right_biceps = $request->right_biceps;
        $measurement->left_forearm = $request->left_forearm;
        $measurement->right_forearm = $request->right_forearm;
        $measurement->chest_bust = $request->chest_bust;
        $measurement->abdomen = $request->abdomen;
        $measurement->waist = $request->waist;
        $measurement->hips = $request->hips;
        $measurement->left_thigh = $request->left_thigh;
        $measurement->right_thigh = $request->right_thigh;
        $measurement->left_calf = $request->left_calf;
        $measurement->right_calf = $request->right_calf;
        $measurement->left_ankle = $request->left_ankle;
        $measurement->right_ankle = $request->right_ankle;
        $measurement->date = $request->date;
        $measurement->note = $request->note;

        return $measurement->save();
    }

    public static function destroy(int $id)
    {
        self::find($id);
        return Measurement::destroy($id);
    }
}
