<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessRefParamRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:47
 * Time: 2021/11/06
 * Class SfMicroprocessRefParamRepository
 * @package App\Repositories
 */
class SfMicroprocessRefParamRepository 
{
    use SfMicroprocessRefParamRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
