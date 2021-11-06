<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:43
 * Time: 2021/11/06
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
