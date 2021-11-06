<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\SecurityLevel;

use App\Requests\SecurityLevelRequest;
use App\Responses\SecurityLevelResponse;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:51
 * Time: 2021/11/06
 * Class SecurityLevelUpdateController
 * @package App\Http\Controllers\SecurityLevel
 */
class SecurityLevelUpdateController
{
/**
     * @OA\Put(
     *      path="/api/security-level/{Id}/update",
     *      tags={"Securitylevel"},
     *      summary="Store Securitylevel Data",
     *      description="Store Securitylevel Data",
     *      @OA\Parameter(
     *          name="Id",
     *          description="Securitylevel Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
     * Returns Securitylevel Update status
     */

    public function __invoke(int $Id,
                             SecurityLevelRequest $securityLevelRequest,
                             SecurityLevelServiceRequest $securityLevelServiceRequest,
                             SecurityLevelService $securityLevelService,
                             SecurityLevelResponse $securityLevelResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $securityLevelValidated = $securityLevelRequest->validated();

        $securityLevelServiceRequest = Lazy::copyFromArray($securityLevelValidated, $securityLevelServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$securityLevelService, 'update'], ['Id' => $Id, 'securityLevelServiceRequest' => $securityLevelServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->securityLevel, $securityLevelResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
