<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AdsOrderDetailRepositoryTrait;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
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
