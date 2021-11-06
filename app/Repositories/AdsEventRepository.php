<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AdsEventRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:53
 * Time: 2021/11/06
 * Class AdsEventRepository
 * @package App\Repositories
 */
class AdsEventRepository 
{
    use AdsEventRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
