<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\OrderRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:13
 * Time: 2022/09/14
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
