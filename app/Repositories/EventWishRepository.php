<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventWishRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:06
 * Time: 2022/09/14
 * Class EventWishRepository
 * @package App\Repositories
 */
class EventWishRepository 
{
    use EventWishRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
