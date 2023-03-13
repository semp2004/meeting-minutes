<?php

namespace App\Enums;

enum Permission
{
    case AdminToolbar;
    case NewUser;
    case EditUser;
    case DeleteUser;

    case NewTemplate;
    case EditTemplate;
}
