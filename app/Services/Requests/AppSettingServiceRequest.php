<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:03
 * Time: 2021/11/06
 * Class AppSettingServiceRequest
 * @package App\Services\Requests
 */
class AppSettingServiceRequest
{
    
    /**
     * @var string
     */
    public $dateTimeFormat;
                
        
    /**
     * @var string
     */
    public $dateFormat;
                
        
    /**
     * @var string
     */
    public $timeFormat;
                
        
    /**
     * @var string
     */
    public $hourMinuteFormat;
                
        
    /**
     * @var int
     */
    public $userId;
                
        
    /**
     * @var int
     */
    public $creatorId;
                
        
    /**
     * @var int
     */
    public $ownerId;
                
}
