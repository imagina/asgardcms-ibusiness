<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\TypeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTypeDecorator extends BaseCacheDecorator implements TypeRepository
{
  public function __construct(TypeRepository $type)
  {
    parent::__construct();
    $this->entityName = 'ibusiness.types';
    $this->repository = $type;
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
