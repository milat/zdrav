<?php

namespace App\Repositories;

use App\Http\Requests\TestRequest;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class TestRepository extends Repository
{
    public static function filter($field = 'description')
    {
        return Test::select($field)
            ->where('user_id', Auth::user()->id)
            ->distinct()
            ->get();
    }

    public static function find(int $id)
    {
        $test = Test::find($id);
        self::validateOwner($test);
        return $test;
    }

    public static function get($description = null)
    {
        $query = Test::where('user_id', Auth::user()->id);

        if ($description) {
            $query->where('description', $description);
        }

        return $query->orderBy('date', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public static function store(TestRequest $request)
    {
        return Test::create([
            'user_id' => Auth::user()->id,
            'test_reference_id' => $request->test_reference_id,
            'description' => $request->description,
            'value' => $request->value,
            'unit' => $request->unit,
            'date' => $request->date,
            'note' => $request->note
        ]);
    }

    public static function update(TestRequest $request, int $id)
    {
        $test = self::find($id);

        $test->test_reference_id = $request->test_reference_id;
        $test->description = $request->description;
        $test->value = $request->value;
        $test->unit = $request->unit;
        $test->date = $request->date;
        $test->note = $request->note;

        return $test->save();
    }

    public static function destroy(int $id)
    {
        self::find($id);
        return Test::destroy($id);
    }
}
