<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Repositories\ScoreRepository;
use App\Http\Requests\HydrationRequest;
use App\Repositories\HydrationRepository;

class HydrationController extends Controller
{
    public function view(): View
    {
        return view('hydration.index')->with([
            'hydrations' => HydrationRepository::get()
        ]);
    }

    public function create()
    {
        return view('hydration.create')->with([
            'scores' => ScoreRepository::get()
        ]);
    }

    public function store(HydrationRequest $request)
    {
        try {
            HydrationRepository::store($request);
            return $this->returnViewWithSuccessMessage('hydration.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function edit(int $id)
    {
        return view('hydration.create')->with([
            'hydration' => HydrationRepository::find($id),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function update(HydrationRequest $request, int $id)
    {
        try {
            HydrationRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('hydration.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function destroy(int $id)
    {
        try {
            HydrationRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('hydration.view', __('messages.destroy_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
