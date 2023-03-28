<?php

namespace App\View\Components;

use App\Enums\Permission;
use App\Models\UserPermission;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use LaravelIdea\Helper\App\Models\_IH_UserPermission_C;

class HasPermission extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $permissionName)
    {
    }

    /**
     * Turn a permission name into the key
     * @param string $value the value to look for
     * @return int the key of the value in Permissions
     */
    private function PermissionValueToKey(string $value): int
    {
        $Cases = Permission::cases();
        $ReturnValue = 0;
        for ($i = 0; $i < count($Cases); $i++) {
            if ($Cases[$i]->name == $value) {
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
        $TryCache = Cache::get('user_permissions_'.$UserId);
        if($TryCache) return $TryCache;

        $UserPermissions = UserPermission::where('user_id', $UserId)->get('permission_id');
        Cache::set('user_permissions_'.$UserId, $UserPermissions, 600);

        return $UserPermissions;
    }


    /**
     * Check if the user has the $permission.
     * @return bool user has permission
     */
    private function HasPermissions(): bool
    {
        $User = auth()->user()?->id;
        if (!$User) return false;

        $UserPermissions = $this->GetUserPermissions($User);


        $PermissionId = $this->PermissionValueToKey(value: $this->permissionName);
        $HasPermissions = $UserPermissions->pluck('permission_id')->contains($PermissionId);
        return $HasPermissions;
    }

    /**
     * Returns a div with an empty string if not authenticated
     * else return the has-permission component, which just renders the $slot
     */
    public function render(): View|Closure|string
    {
        if (!$this->HasPermissions()) {
            return "";
        }
        return view(view: 'components.has-permission');
    }
}
