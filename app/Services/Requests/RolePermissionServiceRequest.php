<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:04:20
 * Time: 2022/09/14
 * Class RolePermissionServiceRequest
 * @package App\Services\Requests
 */
class RolePermissionServiceRequest
{
    
    /**
     * @var int
     */
    public $roleId;
                
        
    /**
     * @var int
     */
    public $permissionId;
                
        
    /**
     * @var int
     */
    public $createdBy;
                
        
    /**
     * @var int
     */
    public $updatedBy;
                
}
