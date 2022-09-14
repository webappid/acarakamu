<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\RoleRouteRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:21
 * Time: 2022/09/14
 * Class RoleRouteRepository
 * @package App\Repositories
 */
class RoleRouteRepository 
{
    use RoleRouteRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
