<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventHistoryRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
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
