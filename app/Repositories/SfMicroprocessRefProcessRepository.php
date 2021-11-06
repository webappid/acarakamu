<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessRefProcessRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:49
 * Time: 2021/11/06
 * Class SfMicroprocessRefProcessRepository
 * @package App\Repositories
 */
class SfMicroprocessRefProcessRepository 
{
    use SfMicroprocessRefProcessRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
