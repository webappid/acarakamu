<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventStatusRefRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:10
 * Time: 2021/11/06
 * Class EventStatusRefRepository
 * @package App\Repositories
 */
class EventStatusRefRepository 
{
    use EventStatusRefRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
