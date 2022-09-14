<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Responses;

/**
 * @author: 
 * Date: 16:04:20
 * Time: 2022/09/14
 * Class RolePermissionRepositoryRequest
 * @package App\Responses
 */
class RolePermissionResponse
{
    
    /**
     * @var int
     */
    public $id;
                
        
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
                
        
    /**
     * @var string
     */
    public $createdAt;
                
        
    /**
     * @var string
     */
    public $updatedAt;
                
}
