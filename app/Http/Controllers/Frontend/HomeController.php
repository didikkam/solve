<?php

namespace App\Http\Controllers\Frontend;

use Redirect;
use Request;

/**
 * Class HomeController.
 */
class HomeController
{
   /**
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    */
   public function index(Request $request)
   {
      return view('frontend.index');
   }
}
