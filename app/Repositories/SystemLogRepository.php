<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SystemLogRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:44
 * Time: 2022/09/14
 * Class SystemLogRepository
 * @package App\Repositories
 */
class SystemLogRepository 
{
    use SystemLogRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
