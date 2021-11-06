<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:04:03
 * Time: 2021/11/06
 * Class AppSettingRepositoryRequest
 * @package App\Repositories\Requests
 */
class AppSettingRepositoryRequest
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
