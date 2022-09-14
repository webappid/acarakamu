<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfModuleRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:40
 * Time: 2022/09/14
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
