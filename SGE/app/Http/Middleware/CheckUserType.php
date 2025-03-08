<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $userType): Response
    {
        if (!Auth::check() || Auth::user()->user_type !== $userType) {
            if (Auth::check()) {
                // Redirecionar para o dashboard apropriado
                if (Auth::user()->user_type === 'student') {
                    return redirect()->route('studentdashboard');
                } else {
                    return redirect()->route('teacherdashboard');
                }
            }
            
            return redirect()->route('login');
        }

        return $next($request);
    }
}