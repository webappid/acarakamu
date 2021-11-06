<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\MigrationRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:19
 * Time: 2021/11/06
 * Class MigrationRepository
 * @package App\Repositories
 */
class MigrationRepository 
{
    use MigrationRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
