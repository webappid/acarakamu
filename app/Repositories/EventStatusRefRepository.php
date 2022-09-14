<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventStatusRefRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:04
 * Time: 2022/09/14
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
