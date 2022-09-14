<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\OrderStatusRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:16
 * Time: 2022/09/14
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
