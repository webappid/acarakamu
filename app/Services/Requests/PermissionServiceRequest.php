<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:25
 * Time: 2021/11/06
 * Class PermissionServiceRequest
 * @package App\Services\Requests
 */
class PermissionServiceRequest
{
    
    /**
     * @var string
     */
    public $name;
                
        
    /**
     * @var string
     */
    public $description;
                
        
    /**
     * @var int
     */
    public $createdBy;
                
        
    /**
     * @var int
     */
    public $updatedBy;
                
}
