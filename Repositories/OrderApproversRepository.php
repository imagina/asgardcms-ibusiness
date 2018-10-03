<?php

namespace Modules\Ibusiness\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface OrderApproversRepository extends BaseRepository
{
  public function validateAllApproversApproved($order_id);
}
