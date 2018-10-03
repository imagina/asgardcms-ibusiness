<?php

namespace Modules\Ibusiness\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface BusinessProductRepository extends BaseRepository
{
  public function relationProduct($business_id,$product_id);
  public function allProductOfBusiness($business_id);
  public function allProductOfBusinessTest($business_id,$filters,$includes);
}
