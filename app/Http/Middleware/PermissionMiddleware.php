<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permissions): Response
    {
        $allowed = true;
        $UserId = $request->user()?->id;

        $PermissionArray = explode('&', $permissions);


        $PermissionArray = array_map(function ($permission) {
            return $this->PermissionToId($permission);
        }, $PermissionArray);

        $UserModel = User::where('id', $UserId) -> first();
        $UserPermissions = $UserModel -> permissions;

        foreach ($PermissionArray as $PermissionArrayItem) {
            if (!$UserPermissions->contains($PermissionArrayItem)) {
                $allowed = false;
            }
        }

        if ($allowed) {
            return $next($request);
        } else {
            abort(403);
        }

    }

    private function PermissionToId($permission): int {
        $PermissionModel = Permission::where('name', $permission) -> firstOrFail();
        return $PermissionModel -> id;
    }
}
