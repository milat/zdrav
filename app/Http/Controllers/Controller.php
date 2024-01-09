<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use function Laravel\Prompts\error;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function returnBackWithError(Exception $exception, bool $tellTheTruth = false)
    {
        error($exception->getMessage());

        $errorMessage = ($tellTheTruth) ? $exception->getMessage() : __('messages.generic_error');

        return redirect()->back()->withErrors([
            'form' => $errorMessage
        ]);
    }

    protected function returnViewWithSuccessMessage(string $routeName, string $message)
    {
        return redirect()->route($routeName)->with([
            'success' => true,
            'message' => $message
        ]);
    }
}
