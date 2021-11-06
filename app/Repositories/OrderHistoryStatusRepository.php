<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\OrderHistoryStatusRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:23
 * Time: 2021/11/06
 * Class OrderHistoryStatusRepository
 * @package App\Repositories
 */
class OrderHistoryStatusRepository 
{
    use OrderHistoryStatusRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
