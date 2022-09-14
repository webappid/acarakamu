<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SecurityLevel;

use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:54
 * Time: 2022/09/14
 * Class SecurityLevelDeleteController
 * @package App\Http\Controllers\SecurityLevel
 */
class SecurityLevelDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/security-level/{Id}/delete",
     *      tags={"Securitylevel"},
     *      summary="Get Securitylevel List",
     *      description="Returns Securitylevel List",
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
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
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
    public function __invoke(int $Id,
                             SecurityLevelService $securityLevelService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$securityLevelService, 'delete'], compact('Id'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.security-level.index'));
        }

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
