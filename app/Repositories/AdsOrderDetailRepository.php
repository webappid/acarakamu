<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AdsOrderDetailRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:55
 * Time: 2021/11/06
 * Class AdsOrderDetailRepository
 * @package App\Repositories
 */
class AdsOrderDetailRepository 
{
    use AdsOrderDetailRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
