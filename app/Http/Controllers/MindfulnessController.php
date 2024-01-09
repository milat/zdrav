<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\MindfulnessRequest;
use App\Repositories\MindfulnessRepository;
use App\Repositories\ScoreRepository;

class MindfulnessController extends Controller
{
    public function view(): View
    {
        return view('mindfulness.index')->with([
            'mindfulnesses' => MindfulnessRepository::get()
        ]);
    }

    public function create()
    {
        return view('mindfulness.create')->with([
            'scores' => ScoreRepository::get()
        ]);
    }

    public function store(MindfulnessRequest $request)
    {
        try {
            MindfulnessRepository::store($request);
            return $this->returnViewWithSuccessMessage('mindfulness.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function edit(int $id)
    {
        return view('mindfulness.create')->with([
            'mindfulness' => MindfulnessRepository::find($id),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function update(MindfulnessRequest $request, int $id)
    {
        try {
            MindfulnessRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('mindfulness.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function destroy(int $id)
    {
        try {
            MindfulnessRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('mindfulness.view', __('messages.destroy_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
