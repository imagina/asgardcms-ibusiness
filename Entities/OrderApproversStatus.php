<?php

namespace Modules\Ibusiness\Entities;

/**
 * Class Status
 * @package Modules\ibusiness\Entities
 */
class OrderApproversStatus
{

    const APPROVED = 0; // SAME 'PROCCESING' in Order Status
    const CANCELED = 2;
    const DENIED = 4;
    const PENDING = 10;
   
    
    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::APPROVED=> trans('ibusiness::frontend.status.approved'),
            self::CANCELED => trans('icommerce::order_status.canceled'),
            self::DENIED => trans('icommerce::order_status.denied'),
            self::PENDING => trans('icommerce::order_status.pending'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::PENDING];
    }
}
