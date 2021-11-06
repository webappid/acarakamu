<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfUserResetPasswordHistRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:54
 * Time: 2021/11/06
 * Class SfUserResetPasswordHistRepository
 * @package App\Repositories
 */
class SfUserResetPasswordHistRepository 
{
    use SfUserResetPasswordHistRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
