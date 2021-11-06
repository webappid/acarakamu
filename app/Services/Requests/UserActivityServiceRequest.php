<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:58
 * Time: 2021/11/06
 * Class UserActivityServiceRequest
 * @package App\Services\Requests
 */
class UserActivityServiceRequest
{
    
    /**
     * @var int
     */
    public $userId;
                
        
    /**
     * @var string
     */
    public $activity;
                
        
    /**
     * @var string
     */
    public $tz;
                
}
