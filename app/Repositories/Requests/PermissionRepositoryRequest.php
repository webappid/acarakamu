<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:04:25
 * Time: 2021/11/06
 * Class PermissionRepositoryRequest
 * @package App\Repositories\Requests
 */
class PermissionRepositoryRequest
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
