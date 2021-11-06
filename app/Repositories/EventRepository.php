<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:06
 * Time: 2021/11/06
 * Class EventRepository
 * @package App\Repositories
 */
class EventRepository 
{
    use EventRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
