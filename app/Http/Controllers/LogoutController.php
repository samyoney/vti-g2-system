<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request): void
    {
        auth() -> guard('api') -> logout();
    }
}
