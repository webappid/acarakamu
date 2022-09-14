<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\FailedJobRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:07
 * Time: 2022/09/14
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
