<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:15
 * Time: 2021/11/06
 * Class ImageServiceRequest
 * @package App\Services\Requests
 */
class ImageServiceRequest
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
