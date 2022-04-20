<?php

namespace App\Http\Controllers\Backend;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // return json_encode(auth()->user()->roles[0]['permissions'][0]->name);
        return view('backend.dashboard');
    }
}
