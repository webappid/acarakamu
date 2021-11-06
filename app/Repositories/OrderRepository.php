<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\OrderRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:20
 * Time: 2021/11/06
 * Class OrderRepository
 * @package App\Repositories
 */
class OrderRepository 
{
    use OrderRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
