<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        // Get the user's role
        $userRole = $request->user()->type;

        // Check if the user has the required role
        if ($userRole !== UserTypeEnum::from($type)->value) {
            // Abort with 403 Forbidden if the role doesn't match
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
