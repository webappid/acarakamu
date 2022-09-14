<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:00
 * Time: 2022/09/14
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
