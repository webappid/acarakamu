<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessRefParamRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:37
 * Time: 2022/09/14
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
