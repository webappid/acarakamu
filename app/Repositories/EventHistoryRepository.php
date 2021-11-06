<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventHistoryRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:08
 * Time: 2021/11/06
 * Class EventHistoryRepository
 * @package App\Repositories
 */
class EventHistoryRepository 
{
    use EventHistoryRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
