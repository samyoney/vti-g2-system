<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Controller as BaseController;

class SpaController extends BaseController
{
    /**
     * Renders the main app screen
     */
    public function __invoke(): Application|Factory|View
    {
        return view('index');
    }
}
