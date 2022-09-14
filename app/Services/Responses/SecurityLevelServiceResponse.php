<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\SecurityLevel;
use WebAppId\SmartResponse\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 16:03:54
 * Time: 2022/09/14
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
