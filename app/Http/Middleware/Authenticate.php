<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            Log::info('Authenticated User:', ['user' => $request->user()]);
        } else {
            Log::info('No authenticated user');
        }
        // $user = $request->user();
        // if (is_null($user)) {
        //     return redirect()->route('auth.login')->withErrors(['error' => 'Unauthorized']);
        // }
        // $token = $user->currentAccessToken();
        // $validUntilDate = $token->created_at->addDays(7);

        // if ($validUntilDate->isPast()) {
        //     return redirect()->route('auth.login')->withErrors(['error' => 'Token Expired']);
        // }

        // $request->merge(['loginUser' => $user]);
        return $next($request);
    }
}
