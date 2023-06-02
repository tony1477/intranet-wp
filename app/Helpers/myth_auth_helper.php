<?php

use Myth\Auth\Models\UserModel;

if (! function_exists('getidfromname')) {
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