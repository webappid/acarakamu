<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SecurityLevel;

use App\Requests\SecurityLevelRequest;
use App\Responses\SecurityLevelResponse;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:50
 * Time: 2021/11/06
 * Class SecurityLevelStoreController
 * @package App\Http\Controllers\SecurityLevel
 */
class SecurityLevelStoreController
{
/**
     * @OA\Post(
     *      path="/api/security-level/store",
     *      tags={"Securitylevel"},
     *      summary="Store Securitylevel Data",
     *      description="Store Securitylevel Data",
     *      @OA\Parameter(
     *          name="Label",
     *          in="query",
     *          required=true,
     *          description="SecurityLevel Label",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="IsMMEM",
     *          in="query",
     *          required=true,
     *          description="SecurityLevel IsMMEM",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=201,
     *          description="Store Data Success"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="System error"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Securitylevel Store status
     */
    /**
     * @param SecurityLevelRequest $securityLevelRequest
     * @param SecurityLevelServiceRequest $securityLevelServiceRequest
     * @param SecurityLevelService $securityLevelService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(SecurityLevelRequest $securityLevelRequest,
                             SecurityLevelServiceRequest $securityLevelServiceRequest,
                             SecurityLevelService $securityLevelService,
                             SecurityLevelResponse $securityLevelResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $securityLevelValidated = $securityLevelRequest->validated();

        $securityLevelServiceRequest = Lazy::copyFromArray($securityLevelValidated, $securityLevelServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$securityLevelService, 'store'], ['securityLevelServiceRequest' => $securityLevelServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->securityLevel, $securityLevelResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            return $smartResponse->saveDataFailed($response);
        }
    }
}
