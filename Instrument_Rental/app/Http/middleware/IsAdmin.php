<?php
namespace App\Http\Middleware;



use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IsAdmin
 *
 * Middleware to restrict access to admin-only routes.
 * Returns a 403 JSON response if the user is not authenticated
 * or does not have admin privileges.
 *
 * @package App\Http\Middleware
 */
class IsAdmin
{
  public function handle (Request $request, Closure $next): Response
  {
      if(!$request->user() || !$request->user()->isAdmin())
      {
          return response()->json(['message' => 'Access Denied'], 403);
      }

      return $next($request);
  }
}
