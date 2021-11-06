<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfModuleRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:50
 * Time: 2021/11/06
 * Class SfModuleRepository
 * @package App\Repositories
 */
class SfModuleRepository 
{
    use SfModuleRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
