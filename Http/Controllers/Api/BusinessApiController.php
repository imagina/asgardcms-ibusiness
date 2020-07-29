<?php

namespace Modules\Ibusiness\Http\Controllers\Api;

// Requests & Response
use Modules\Ibusiness\Http\Requests\CreateBusinessRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Exception;

// Transformers
use Modules\Ibusiness\Transformers\BusinessTransformer;

// Entities
use Modules\Ibusiness\Entities\Business;

// Repositories
use Modules\Ibusiness\Repositories\BusinessRepository;

//External libraries
use Modules\Setting\Contracts\Setting;

class BusinessApiController extends BaseApiController
{
    private $business;
    private $setting;

    public function __construct(
        BusinessRepository $business,
        Setting $setting
    )
    {
        $this->business = $business;
        $this->setting = $setting;

    }

    /**
     * Get List
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->business->getItemsBy($params);

            //Response
            $response = ['data' => BusinessTransformer::collection($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;

        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = [
                "errors" => $e->getMessage()
            ];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * GET A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->business->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new \Exception('Item not found', 404);

            //Response
            $response = ["data" => new BusinessTransformer($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = [
                "errors" => $e->getMessage()
            ];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * CREATE A ITEM
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = $request->input('attributes') ?? [];//Get data

            //Validate Request
            $this->validateRequestApi(new CreateBusinessRequest($data));

            //Create item
            $entity = $this->business->create($data);

            //Response
            $response = [
                "data" =>  "Request successful"
            ];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = [
              "errors" => $e->getMessage(),
              "line" => $e->getLine(),
              "trace" => $e->getTrace(),
          ];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * UPDATE ITEM
     *
     * @param $criteria
     * @param Request $request
     * @return mixed
     */
    public function update($criteria, Request $request)
    {
        \DB::beginTransaction(); //DB Transaction
        try {
            //Get data
            $data = $request->input('attributes') ?? [];//Get data

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            $dataEntity = $this->business->getItem($criteria, $params);

            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Request to Repository
            $this->business->update($dataEntity, $data);
            //Response
            $response = ["data" => 'Item Updated'];
            \DB::commit();//Commit to DataBase
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * DELETE A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function delete($criteria, Request $request)
    {
        \DB::beginTransaction();
        try {
            //Get params
            $params = $this->getParamsRequest($request);

            $dataEntity = $this->business->getItem($criteria, $params);

            if (!$dataEntity) throw new Exception('Item not found', 204);

            //call Method delete
            $this->business->destroy($dataEntity);

            //Response
            $response = ["data" => "Item deleted"];
            \DB::commit();//Commit to Data Base
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

}
