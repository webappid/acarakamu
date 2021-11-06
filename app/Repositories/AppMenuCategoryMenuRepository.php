<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AppMenuCategoryMenuRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:58
 * Time: 2021/11/06
 * Class AppMenuCategoryMenuRepository
 * @package App\Repositories
 */
class AppMenuCategoryMenuRepository 
{
    use AppMenuCategoryMenuRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
