<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Responses;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppMenuRepositoryRequest
 * @package App\Responses
 */
class AppMenuResponse
{
    
    /**
     * @var int
     */
    public $id;
                
        
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
                
        
    /**
     * @var string
     */
    public $createdAt;
                
        
    /**
     * @var string
     */
    public $updatedAt;
                
}
