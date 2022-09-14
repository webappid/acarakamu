<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfAccessRefRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:23
 * Time: 2022/09/14
 * Class SfAccessRefRepository
 * @package App\Repositories
 */
class SfAccessRefRepository 
{
    use SfAccessRefRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
