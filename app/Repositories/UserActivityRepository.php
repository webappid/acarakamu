<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\UserActivityRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:58
 * Time: 2021/11/06
 * Class UserActivityRepository
 * @package App\Repositories
 */
class UserActivityRepository 
{
    use UserActivityRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
