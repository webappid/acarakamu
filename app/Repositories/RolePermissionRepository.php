<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\RolePermissionRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:30
 * Time: 2021/11/06
 * Class RolePermissionRepository
 * @package App\Repositories
 */
class RolePermissionRepository 
{
    use RolePermissionRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
