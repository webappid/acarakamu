<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Responses;

/**
 * @author: 
 * Date: 14:04:58
 * Time: 2021/11/06
 * Class UserActivityRepositoryRequest
 * @package App\Responses
 */
class UserActivityResponse
{
    
    /**
     * @var int
     */
    public $id;
                
        
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
                
        
    /**
     * @var string
     */
    public $createdAt;
                
        
    /**
     * @var string
     */
    public $updatedAt;
                
}
