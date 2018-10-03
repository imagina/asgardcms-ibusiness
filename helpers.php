<?php

use Modules\Ibusiness\Entities\OrderApproversStatus;


/**
 * Get Approver Status 
 *
 * @param  none
 * @return Array $status
 */
if (!function_exists('ibusiness_get_Approverstatus')) {

    function ibusiness_get_Approverstatus()
    {
        $status = new OrderApproversStatus();
        return $status;
    }
}