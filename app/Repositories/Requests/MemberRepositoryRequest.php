<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:04:09
 * Time: 2022/09/14
 * Class MemberRepositoryRequest
 * @package App\Repositories\Requests
 */
class MemberRepositoryRequest
{
    
    /**
     * @var int
     */
    public $memberUserId;
                
        
    /**
     * @var string
     */
    public $memberFirstName;
                
        
    /**
     * @var string
     */
    public $memberLastName;
                
        
    /**
     * @var string
     */
    public $memberEmail;
                
        
    /**
     * @var int
     */
    public $memberImageId;
                
        
    /**
     * @var string
     */
    public $memberNoTelp;
                
        
    /**
     * @var string
     */
    public $memberDateChange;
                
}
