<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    private function hasRole($roles, $role)
    {
        foreach ($roles as $item) {
            if ($item->categoryRole->code == $role) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()) {
            return response()->json([
                'error_code' => '400',
                'msg' => 'Unauthenticated user',
            ]);
        }

        $roles = $request->user()->roles;
        if ($this->hasRole($roles, 'SupperUser')) {
            return $next($request);
        }

        if (!$this->hasRole($roles, $role)) {
            return response()->json(
                [
                    'error_code' => '400',
                    'msg' => 'Permission denied',
                ]
            );
        }

        return $next($request);
    }
}
