<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:30
 * Time: 2021/11/06
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
