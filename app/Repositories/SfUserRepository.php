<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfUserRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:41
 * Time: 2022/09/14
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
