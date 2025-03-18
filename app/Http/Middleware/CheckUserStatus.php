<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->type === 'supplier') {
                if ($user->supplier->status === 'inactive') {
                    return redirect()->route('supplier.profile')->with('status', 'Your profile is under review.');
                } elseif ($user->supplier->status === 'declined') {
                    return redirect()->route('supplier.profile')->with('status', 'Your access is declined.');
                }
            } elseif ($user->type === 'buyer') {
                if ($user->buyer->status === 'inactive') {
                    return redirect()->route('buyer.profile')->with('status', 'Your profile is under review.');
                } elseif ($user->buyer->status === 'declined') {
                    return redirect()->route('buyer.profile')->with('status', 'Your access is declined.');
                }
            }
        }

        return $next($request);

    }
}
