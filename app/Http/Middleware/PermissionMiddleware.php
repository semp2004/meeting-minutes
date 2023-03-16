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
     * @param string  $permissions the permissions that are required, this is a string with the permissions separated by &
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $permissions): Response
    {
        $PermissionArray = explode('&', $permissions);

        $UserId = $request->user()?->id;
        $UserModel = User::where('id', $UserId) -> FirstOrFail();
        $UserPermissions = $UserModel -> permissions;

        // Convert the permission names to ids
        $PermissionArray = array_map(function ($permission) {
            return $this->PermissionToId($permission);
        }, $PermissionArray);


        // Loop through the required permissions and check if the user has them, if the user doesn't have one of the permissions, set $Allowed to false
        foreach ($PermissionArray as $PermissionArrayItem) {
            if (!$UserPermissions->contains($PermissionArrayItem)) {
                return abort(403);
            }
        }

        // If the user has all the permissions, return the next middleware
        return $next($request);


    }

    /**
     * Get the id of a permission name with cache
     * @param string $permission the name of the permission
     * @return int the id of the permission
     */
    private function PermissionToId(String $permission): int {
        $CachePrefix = 'permissions_';
        $CacheItem = \Cache::get($CachePrefix .$permission);

        if ($CacheItem) {
            return $CacheItem;
        }

        $PermissionModel = Permission::where('name', $permission) -> firstOrFail();

        \Cache::put($CachePrefix .$permission, $PermissionModel -> id, 60 * 5);

        return $PermissionModel -> id;
    }
}
