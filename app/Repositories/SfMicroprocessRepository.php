<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:33
 * Time: 2022/09/14
 * Class SfMicroprocessRepository
 * @package App\Repositories
 */
class SfMicroprocessRepository 
{
    use SfMicroprocessRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
