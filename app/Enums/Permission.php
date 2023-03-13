<?php

namespace App\Enums;

enum Permission
{
    case AdminView;
    case NewUser;
    case EditUser;
    case DeleteUser;

    case NewTemplate;
    case EditTemplate;
}
