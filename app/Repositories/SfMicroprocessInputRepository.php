<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessInputRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:34
 * Time: 2022/09/14
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
