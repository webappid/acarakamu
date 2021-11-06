<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\SecurityLevel;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 14:03:50
 * Time: 2021/11/06
 * Class SecurityLevelServiceResponse
 * @package App\Services\Responses
 */
class SecurityLevelServiceResponse extends AbstractResponse
{
    /**
     * @var SecurityLevel
     */
    public $securityLevel;
}
