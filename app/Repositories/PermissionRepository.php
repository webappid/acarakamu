<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\PermissionRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:25
 * Time: 2021/11/06
 * Class PermissionRepository
 * @package App\Repositories
 */
class PermissionRepository 
{
    use PermissionRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
