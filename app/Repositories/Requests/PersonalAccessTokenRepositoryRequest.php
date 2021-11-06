<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:04:27
 * Time: 2021/11/06
 * Class PersonalAccessTokenRepositoryRequest
 * @package App\Repositories\Requests
 */
class PersonalAccessTokenRepositoryRequest
{
    
    /**
     * @var string
     */
    public $tokenableType;
                
        
    /**
     * @var int
     */
    public $tokenableId;
                
        
    /**
     * @var string
     */
    public $name;
                
        
    /**
     * @var string
     */
    public $token;
                
        
    /**
     * @var string
     */
    public $abilities;
                
        
    /**
     * @var string
     */
    public $lastUsedAt;
                
}
