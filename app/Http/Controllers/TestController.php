<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Repositories\TestReferenceRepository;
use App\Repositories\TestRepository;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\View\View;
use App\Repositories\ScoreRepository;

class TestController extends Controller
{
    public function filter($field = 'description')
    {
        return TestRepository::filter($field);
    }

    public function view(Request $request): View
    {
        return view('test.index')->with([
            'tests' => TestRepository::get($request->filter)
        ]);
    }

    public function create()
    {
        return view('test.create')->with([
            'references' => TestReferenceRepository::get(),
            'descriptionSuggestions' => TestRepository::filter(),
            'unitSuggestions' => TestRepository::filter('unit'),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function store(TestRequest $request)
    {
        try {
            TestRepository::store($request);
            return $this->returnViewWithSuccessMessage('test.view', __('messages.store_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function edit(int $id)
    {
        return view('test.create')->with([
            'test' => TestRepository::find($id),
            'references' => TestReferenceRepository::get(),
            'descriptionSuggestions' => TestRepository::filter(),
            'unitSuggestions' => TestRepository::filter('unit'),
            'scores' => ScoreRepository::get()
        ]);
    }

    public function update(TestRequest $request, int $id)
    {
        try {
            TestRepository::update($request, $id);
            return $this->returnViewWithSuccessMessage('test.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }

    public function destroy(int $id)
    {
        try {
            TestRepository::destroy($id);
            return $this->returnViewWithSuccessMessage('test.view', __('messages.destroy_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
