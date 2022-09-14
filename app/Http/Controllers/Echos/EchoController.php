<?php
/**
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Echos;


use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 22/10/2021
 * Time: 10.49
 * Class EchoController
 * @package App\Http\Controllers\Echos
 */
class EchoController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="OpenApi",
     *      description="Swagger OpenApi description",
     *      @OA\Contact(
     *          email="dyan.galih@gmail.com"
     *      ),
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
     */
    public function __invoke(
        SmartResponse $smartResponse,
        Response      $response)
    {
        return $smartResponse->success($response);
    }
}
