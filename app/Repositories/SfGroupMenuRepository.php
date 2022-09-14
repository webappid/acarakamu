<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfGroupMenuRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:26
 * Time: 2022/09/14
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
