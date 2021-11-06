<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfGroupModuleRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:36
 * Time: 2021/11/06
 * Class SfGroupModuleRepository
 * @package App\Repositories
 */
class SfGroupModuleRepository 
{
    use SfGroupModuleRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
