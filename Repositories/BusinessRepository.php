<?php

namespace Modules\Ibusiness\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface BusinessRepository extends BaseRepository
{
  public function getItemsBy($params);

  public function getItem($criteria, $params);
  
}
