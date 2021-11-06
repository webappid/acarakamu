<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AdsRefPriceRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:56
 * Time: 2021/11/06
 * Class AdsRefPriceRepository
 * @package App\Repositories
 */
class AdsRefPriceRepository 
{
    use AdsRefPriceRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
