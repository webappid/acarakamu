<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\FontIconRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:14
 * Time: 2021/11/06
 * Class FontIconRepository
 * @package App\Repositories
 */
class FontIconRepository 
{
    use FontIconRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
