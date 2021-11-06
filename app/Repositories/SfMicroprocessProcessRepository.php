<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessProcessRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:46
 * Time: 2021/11/06
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
