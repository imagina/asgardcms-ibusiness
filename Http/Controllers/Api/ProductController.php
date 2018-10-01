<?php

namespace Modules\Ibusiness\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Log;
use Modules\Notification\Services\Notification;
use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;
use Route;
use Modules\Ibusiness\Repositories\BusinessProductRepository;
use Modules\Ibusiness\Repositories\OrderApproversRepository;
use Modules\Ibusiness\Transformers\BusinessProductsTransformer;
class ProductController extends BasePublicController
{
  protected $auth;
  private $user;
  private $notification;
  private $businessproduct;
  private $orderApprovers;

  public function __construct(
    Notification $notification,
    Authentication $auth,
    UserRepository $user,
    BusinessProductRepository $businessproduct,
    OrderApproversRepository $orderApprovers
    )
    {

      parent::__construct();
      $this->auth = $auth;
      $this->user = $user;
      $this->notification = $notification;
      $this->businessproduct = $businessproduct;
      $this->orderApprovers = $orderApprovers;

    }
    public function Product(Request $request){
      try {
        if (isset($request->include)) {
          // $includes = explode(",", $request->include);
          $includes = $request->includes;
        } else {
          $includes = null;
        }
        if (isset($request->filters) && !empty($request->filters)) {
          $filters = json_decode($request->filters);
          $results=$this->businessproduct->whereFilters($filters,$request->includes);
          if (isset($filters->take)) {
            $response = [
              'meta' => [
                "take" => $filters->take ?? 5,
                "skip" => $filters->skip ?? 0,
              ],
              'data' => BusinessProductsTransformer::collection($results),
            ];
          } else {
            $response = [
              'meta' => [
                "total-pages" => $results->lastPage(),
                "per_page" => $results->perPage(),
                "total-item" => $results->total()
              ],
              'data' => BusinessProductsTransformer::collection($results),
              'links' => [
                "self" => $results->currentPage(),
                "first" => $results->hasMorePages(),
                "prev" => $results->previousPageUrl(),
                "next" => $results->nextPageUrl(),
                "last" => $results->lastPage()
              ]
            ];
          }//else
        } else {
          $results = $this->businessproduct->paginate($request->paginate ?? 12);
          $response = [
            'meta' => [
              "total-pages" => $results->lastPage(),
              "per_page" => $results->perPage(),
              "total-item" => $results->total()
            ],
            'data' => BusinessProductsTransformer::collection($results),
            'links' => [
              "self" => $results->currentPage(),
              "first" => $results->hasMorePages(),
              "prev" => $results->previousPageUrl(),
              "next" => $results->nextPageUrl(),
              "last" => $results->lastPage()
            ]
          ];
        }
      } catch (\ErrorException $e) {
        Log::error($e);
        $status = 500;
        $response = ['errors' => [
          "code" => "501",
          "source" => [
            "pointer" => url($request->path()),
          ],
          "title" => "Error Business product",
          "detail" => $e->getMessage()
        ]
      ];
    }//catch
    return response()->json($response, $status ?? 200);

  }//BusinessProducts()
}
