<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMicroprocessRefProcessRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:38
 * Time: 2022/09/14
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
