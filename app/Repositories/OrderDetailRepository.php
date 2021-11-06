<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\OrderDetailRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:21
 * Time: 2021/11/06
 * Class OrderDetailRepository
 * @package App\Repositories
 */
class OrderDetailRepository 
{
    use OrderDetailRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
