<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:04:43
 * Time: 2022/09/14
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
