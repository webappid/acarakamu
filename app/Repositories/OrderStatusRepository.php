<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\OrderStatusRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:24
 * Time: 2021/11/06
 * Class OrderStatusRepository
 * @package App\Repositories
 */
class OrderStatusRepository 
{
    use OrderStatusRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
