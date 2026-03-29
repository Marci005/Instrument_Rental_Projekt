<?php
namespace App\Http\middleware;



use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
