<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\AdsEventRepositoryTrait;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
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
