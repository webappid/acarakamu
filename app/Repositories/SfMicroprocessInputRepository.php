<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessInputRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:44
 * Time: 2021/11/06
 * Class SfMicroprocessInputRepository
 * @package App\Repositories
 */
class SfMicroprocessInputRepository 
{
    use SfMicroprocessInputRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
