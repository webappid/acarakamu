<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AppMenuRouteRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Class AppMenuRouteRepository
 * @package App\Repositories
 */
class AppMenuRouteRepository 
{
    use AppMenuRouteRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
