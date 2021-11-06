<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SecurityLevelRepositoryTrait;

/**
 * @author: 
 * Date: 14:03:50
 * Time: 2021/11/06
 * Class SecurityLevelRepository
 * @package App\Repositories
 */
class SecurityLevelRepository 
{
    use SecurityLevelRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
