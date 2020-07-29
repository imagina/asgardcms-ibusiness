<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\BusinessRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBusinessDecorator extends BaseCacheDecorator implements BusinessRepository
{
  public function __construct(BusinessRepository $business)
  {
    parent::__construct();
    $this->entityName = 'ibusiness.businesses';
    $this->repository = $business;
  }

  /**
  * List or resources
  *
  * @return collection
  */
  public function getItemsBy($params)
  {
    return $this->remember(function () use ($params) {
      return $this->repository->getItemsBy($params);
    });
  }

  /**
  * find a resource by id or slug
  *
  * @return object
  */
  public function getItem($criteria, $params)
  {
    return $this->remember(function () use ($criteria, $params) {
      return $this->repository->getItem($criteria, $params);
    });
  }
}
