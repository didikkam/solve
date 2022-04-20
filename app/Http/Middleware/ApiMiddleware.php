<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $requested = $request->header('X-Requested-With');
    if ($requested != "XMLHttpRequest") {
      return response([
        'message'   => 'Your Request Is Bad',
      ], Response::HTTP_BAD_GATEWAY);
    }
    $app_id = $request->header('X-APP-ID');
    if ($app_id != 'id.teknova.app.smkplus') {
      return response([
        'message'   => 'Your Application Is Unauthenticated',
      ], Response::HTTP_UNAUTHORIZED);
    }
    return $next($request);
  }
}
