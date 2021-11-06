<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMenuRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:40
 * Time: 2021/11/06
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
