<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Client;
use Illuminate\Http\Request;

class ActivationMiddlware
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
        $status=Client::where('id',auth('client')->user()->id)->first()->status;
        if($status=='inactive'){
            return response()->json([
                'item' =>[],
                'message' => 'Your Account is Blocked Please Contact Support',
                ],401);
        }
        return $next($request);
    }
}
