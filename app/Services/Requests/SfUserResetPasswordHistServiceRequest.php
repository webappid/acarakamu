<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:54
 * Time: 2021/11/06
 * Class SfUserResetPasswordHistServiceRequest
 * @package App\Services\Requests
 */
class SfUserResetPasswordHistServiceRequest
{
    
    /**
     * @var int
     */
    public $userResetPasswordHistUserId;
                
        
    /**
     * @var string
     */
    public $userResetPasswordHistCode;
                
        
    /**
     * @var string
     */
    public $userResetPasswordHistValidUntil;
                
        
    /**
     * @var string
     */
    public $userResetPasswordHistStatus;
                
}
