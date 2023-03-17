<?php

namespace App\View\Components;

use App\Models\Permission;
use App\Models\User;
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
     * Check if the user has the $permission.
     * @return bool user has permission
     */
    public function HasPermissions(): bool
    {
        $User = auth()->user()?->id;
        if(!$User) {return false;}
        $UserModel = User::where('id', $User || 0)->firstOrFail();
        $UserPermissions = $UserModel->permissions();

        $PermissionId = Permission::where('name', $this->permissionName)->firstOrFail()->id;

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
        return view('components.has-permission');
    }
}
