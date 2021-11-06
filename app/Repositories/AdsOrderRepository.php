<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AdsOrderRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:54
 * Time: 2021/11/06
 * Class AdsOrderRepository
 * @package App\Repositories
 */
class AdsOrderRepository 
{
    use AdsOrderRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
