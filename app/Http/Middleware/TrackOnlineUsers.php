<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TrackOnlineUsers
{
    public function handle($request, Closure $next)
    {
        $user = Auth::check() ? Auth::user() : null;
        $sessionId = session()->getId();
        $current_page = $request->path();

        // Atualizar cache com usuários online
        $onlineUsers = Cache::get('online-users', []);

        $onlineUsers[$sessionId] = [
            'name' => $user ? $user->name : 'Guest',
            'current_page' => $current_page,
            'last_activity' => now()
        ];

        Cache::put('online-users', $onlineUsers, now()->addMinutes(5));

        return $next($request);
    }
}






