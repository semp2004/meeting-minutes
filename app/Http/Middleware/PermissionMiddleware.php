<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{


    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @param string $permissions the permissions that are required, this is a string with the permissions separated by &
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $permissions): Response
    {
        $PermissionArray = explode('&', $permissions);

        $UserId = $request->user()?->id;
        if(!$UserId) abort(403);

        $UserPermissions = $this ->GetUserPermissions($UserId)->pluck('permission_id');



        // Convert the permission names to ids
        $PermissionArray = array_map(function ($permission) {
            return $this->PermissionToId($permission);
        }, $PermissionArray);


        // Loop through the required permissions and check if the user has them, if the user doesn't have one of the permissions, set $Allowed to false
        foreach ($PermissionArray as $PermissionArrayItem) {
            if (!$UserPermissions->contains($PermissionArrayItem)) {
                abort(403);
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
    private function PermissionToId(string $permission): int
    {
        $Cases = \App\Enums\Permission::cases();
        $ReturnValue = 0;
        for ($i = 0; $i < count($Cases); $i++) {
            if ($Cases[$i]->name == $permission) {
                $ReturnValue = $i + 1;
            }
        }
        return $ReturnValue;
    }

    /**
     * Get the user their permissions with integrated caching
     * @param int $UserId The user their permissions
     * @return mixed an object which has the permissions of the user.
     */
    private function GetUserPermissions(int $UserId): mixed
    {
        $TryCache = Cache::get('user_permissions_' . $UserId);
        if ($TryCache) return $TryCache;

        $UserPermissions = UserPermission::where('user_id', $UserId)->get('permission_id');
        Cache::set('user_permissions_' . $UserId, $UserPermissions, 600);

        return $UserPermissions;
    }
}
