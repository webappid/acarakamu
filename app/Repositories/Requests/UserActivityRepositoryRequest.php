<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:04:58
 * Time: 2021/11/06
 * Class UserActivityRepositoryRequest
 * @package App\Repositories\Requests
 */
class UserActivityRepositoryRequest
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
