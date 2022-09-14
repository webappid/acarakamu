<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\ProvincesRefRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:19
 * Time: 2022/09/14
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
