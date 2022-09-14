<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\SecurityLevel;

use App\Requests\SecurityLevelSearchRequest;
use App\Responses\SecurityLevelResponse;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:54
 * Time: 2022/09/14
 * Class SecurityLevelListController
 * @package App\Http\Controllers\SecurityLevel
 */
class SecurityLevelListController
{
    /**
     * @OA\Get(
     *      path="/api/security-level/list",
     *      tags={"Securitylevel"},
     *      summary="Get Securitylevel List",
     *      description="Returns Securitylevel List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Securitylevel q",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=200,
     *          description="Get Data Success"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Securitylevel List
     */
    public function __invoke(
                             SecurityLevelSearchRequest $securityLevelSearchRequest,
                             SecurityLevelService $securityLevelService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $securityLevelSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$securityLevelService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->securityLevelList as $item) {
                $data[] = Lazy::transform($item, new SecurityLevelResponse());
            }
        }

        if ($result->status) {
            $response->setData($data);
            $response->setRecordsTotal($result->count);
            $response->setRecordsFiltered($result->countFiltered);
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
