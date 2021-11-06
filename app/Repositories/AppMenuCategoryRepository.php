<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AppMenuCategoryRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:57
 * Time: 2021/11/06
 * Class AppMenuCategoryRepository
 * @package App\Repositories
 */
class AppMenuCategoryRepository 
{
    use AppMenuCategoryRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
