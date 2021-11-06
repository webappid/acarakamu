<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Responses;

/**
 * @author: 
 * Date: 14:04:28
 * Time: 2021/11/06
 * Class PersonalAccessTokenRepositoryRequest
 * @package App\Responses
 */
class PersonalAccessTokenResponse
{
    
    /**
     * @var int
     */
    public $id;
                
        
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
                
        
    /**
     * @var string
     */
    public $createdAt;
                
        
    /**
     * @var string
     */
    public $updatedAt;
                
}
