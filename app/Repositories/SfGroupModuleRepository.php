<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfGroupModuleRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:27
 * Time: 2022/09/14
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
