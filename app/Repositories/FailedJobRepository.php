<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\FailedJobRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:12
 * Time: 2021/11/06
 * Class FailedJobRepository
 * @package App\Repositories
 */
class FailedJobRepository 
{
    use FailedJobRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
