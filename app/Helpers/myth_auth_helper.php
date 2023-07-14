<?php

use Myth\Auth\Models\UserModel;

if (! function_exists('get_id')) {
    /**
     * Get user ID from name using Myth-Auth library.
     *
     * @param string $username
     * @return int|null
     */
    function get_id(string $username): ?int
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->where('active',1)->first();

        if ($user) {
            return $user->id;
        }

        return null;
    }
}

if (! function_exists('get_username')) {
    /**
     * Get user ID from name using Myth-Auth library.
     *
     * @param int $id
     * @return string|null
     */
    function get_username(int $id): ?string
    {
        $userModel = new UserModel();
        $user = $userModel->where('id', $id)->where('active',1)->first();

        if ($user) {
            return $user->username;
        }

        return null;
    }
}

if (! function_exists('get_fullname')) {
    /**
     * Get user ID from name using Myth-Auth library.
     *
     * @param int $id
     * @return string|null
     */
    function get_fullname(int $id): ?string
    {
        $userModel = new UserModel();
        $user = $userModel->where('id', $id)->where('active',1)->first();

        if ($user) {
            return $user->fullname;
        }

        return null;
    }
}