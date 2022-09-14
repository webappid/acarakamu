<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessProcessRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:36
 * Time: 2022/09/14
 * Class SfMicroprocessProcessRepository
 * @package App\Repositories
 */
class SfMicroprocessProcessRepository 
{
    use SfMicroprocessProcessRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
