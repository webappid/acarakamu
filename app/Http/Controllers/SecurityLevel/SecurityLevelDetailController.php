<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\SecurityLevel;

use App\Responses\SecurityLevelResponse;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:50
 * Time: 2021/11/06
 * Class SecurityLevelDetailController
 * @package App\Http\Controllers\SecurityLevel
 */
class SecurityLevelDetailController
{

    /**
     * @OA\Get(
     *      path="/api/security-level/{Id}/detail",
     *      tags={"Securitylevel"},
     *      summary="Get Securitylevel Detail",
     *      description="Returns Securitylevel Detail",
     *      @OA\Parameter(
     *          name="Id",
     *          description="Securitylevel Id",
     *          required=true,
     *          in="path",
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
     * Returns Securitylevel Detail
     */

    /**
     * @param int $Id
     * @param SecurityLevelService $securityLevelService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $Id,
                             SecurityLevelService $securityLevelService,
                             SecurityLevelResponse $securityLevelResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$securityLevelService, 'getById'], compact('Id'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->securityLevel, $securityLevelResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
