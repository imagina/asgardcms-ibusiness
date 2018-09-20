<?php

namespace Modules\Ibusiness\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface UserBusinessRepository extends BaseRepository
{
  public function getBusinessUser($user_id);
  public function getUsersBuyersOfBusiness($business_id);
}
