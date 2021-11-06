<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\FontIconTypeRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:13
 * Time: 2021/11/06
 * Class FontIconTypeRepository
 * @package App\Repositories
 */
class FontIconTypeRepository 
{
    use FontIconTypeRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
