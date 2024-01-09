<?php

namespace App\Http\Controllers;

use App\Exceptions\WrongPasswordException;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user.create', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UserUpdateRequest $request): RedirectResponse
    {
        try {
            UserRepository::update($request);
            return $this->returnViewWithSuccessMessage('user.edit', __('messages.update_success'));
        } catch (WrongPasswordException $e) {
            return $this->returnBackWithError($e, true);
        } catch (\Exception $e) {
            return $this->returnBackWithError($e, true);
        }
    }
}
