<?php

namespace App\View\Components;

use App\Enums\Permission;
use App\Models\UserPermission;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HasPermission extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $permissionName)
    {
    }

    /**
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
     * Check if the user has the $permission.
     * @return bool user has permission
     */
    private function HasPermissions(): bool
    {
        $User = auth()->user()?->id;
        if (!$User) return false;

        $UserPermissions = UserPermission::where('user_id', $User)->get('permission_id');


        $PermissionId = $this->PermissionValueToKey(value: $this->permissionName);
        $HasPermissions = $UserPermissions->pluck('permission_id')->contains($PermissionId);
        return $HasPermissions;
    }

    /**
     * Returns a div with an empty string if not authenticated
     */
    public function render(): View|Closure|string
    {
        if (!$this->HasPermissions()) {
            return "";
        }
        return view(view: 'components.has-permission');
    }
}
