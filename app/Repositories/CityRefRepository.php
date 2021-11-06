<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\CityRefRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:05
 * Time: 2021/11/06
 * Class CityRefRepository
 * @package App\Repositories
 */
class CityRefRepository 
{
    use CityRefRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
