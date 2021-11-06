<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfGroupMenuRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:35
 * Time: 2021/11/06
 * Class SfGroupMenuRepository
 * @package App\Repositories
 */
class SfGroupMenuRepository 
{
    use SfGroupMenuRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
