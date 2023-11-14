<?php

namespace Synerise\Integration\Service;

class User_Service
{
    public static function is_user_admin(int $user_id): bool
    {
        $user = get_userdata($user_id);
        $roles = $user->roles;

        return in_array('administrator', $roles);
    }

    public static function is_user_customer(int $user_id): bool
    {
        $user = get_userdata($user_id);
        $roles = $user->roles;

        return in_array('customer', $roles);
    }
}
