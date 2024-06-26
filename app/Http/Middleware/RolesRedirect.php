<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolesRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check()) {

            if (auth()->user()->getRoleNames()[0] === 'Super Usuario') {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/folder');
            }
        } else {
            return redirect()->to('/login');
        }
    }
}
