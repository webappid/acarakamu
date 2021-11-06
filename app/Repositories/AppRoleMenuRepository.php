<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AppRoleMenuRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppRoleMenuRepository
 * @package App\Repositories
 */
class AppRoleMenuRepository 
{
    use AppRoleMenuRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
