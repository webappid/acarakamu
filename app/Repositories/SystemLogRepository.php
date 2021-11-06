<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SystemLogRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:56
 * Time: 2021/11/06
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
