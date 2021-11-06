<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\ProvincesRefRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:29
 * Time: 2021/11/06
 * Class ProvincesRefRepository
 * @package App\Repositories
 */
class ProvincesRefRepository 
{
    use ProvincesRefRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
