<?php

namespace Modules\Ibusiness\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface BusinessRepository extends BaseRepository
{
  public function companies();
  public function branchOffice($business_id);
}
