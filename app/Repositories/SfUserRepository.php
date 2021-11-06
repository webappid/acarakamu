<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfUserRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:52
 * Time: 2021/11/06
 * Class SfUserRepository
 * @package App\Repositories
 */
class SfUserRepository 
{
    use SfUserRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
