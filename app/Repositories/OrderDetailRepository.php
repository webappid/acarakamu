<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\OrderDetailRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:14
 * Time: 2022/09/14
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
