<?php

use App\Models\Auth\WfgroupModel;
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

if(!function_exists('getWfbyUserid')) :
    function getWfbyUserid(string $wfname, int $id): ?string
    {
        $model = model('WfgroupModel');
        return $model->getWfstatbyUserId($wfname, $id);
    }
endif;

if(!function_exists('getWfAuthByUserid')):
    function getWfAuthByUserid(string $wfname, int $recordstatus)
    {
        $model = model('WfgroupModel');
        return $model->getWfAuthbyUserId('apphelpdesk',6, 1);
        // return 's';
    }
endif;