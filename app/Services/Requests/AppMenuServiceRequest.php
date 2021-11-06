<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppMenuServiceRequest
 * @package App\Services\Requests
 */
class AppMenuServiceRequest
{
    
    /**
     * @var int
     */
    public $parentId;
                
        
    /**
     * @var string
     */
    public $name;
                
        
    /**
     * @var int
     */
    public $routeId;
                
        
    /**
     * @var string
     */
    public $icon;
                
        
    /**
     * @var int
     */
    public $menuOrder;
                
        
    /**
     * @var string
     */
    public $isActive;
                
}
