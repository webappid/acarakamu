<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMenuRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:31
 * Time: 2022/09/14
 * Class SfMenuRepository
 * @package App\Repositories
 */
class SfMenuRepository 
{
    use SfMenuRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
