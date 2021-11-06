<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:04:15
 * Time: 2021/11/06
 * Class ImageRepositoryRequest
 * @package App\Repositories\Requests
 */
class ImageRepositoryRequest
{
    
    /**
     * @var string
     */
    public $imageName;
                
        
    /**
     * @var string
     */
    public $imageDescription;
                
        
    /**
     * @var string
     */
    public $imageAlt;
                
        
    /**
     * @var int
     */
    public $imageOwnerUserId;
                
        
    /**
     * @var string
     */
    public $imageDateChange;
                
        
    /**
     * @var int
     */
    public $imageUserId;
                
}
