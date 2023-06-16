<?php

use App\Models\ItHelpdeskModel;

if (! function_exists('getUsersbyId')) {
    /**
     * Get user ID from name using Myth-Auth library.
     *
     * @param string $username
     * @return int|null
     */
    function getUsersbyId(int $id): ?string
    {
        $model = new ItHelpdeskModel();
        $user = $model->getUsersbyId($id);

        if ($user) {
            return $user->id;
        }

        return null;
    }
}