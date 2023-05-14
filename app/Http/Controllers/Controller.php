<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(): Response
    {
        return inertia('Index', [
            'title' => fn () => config('app.name')
        ]);
    }
}
