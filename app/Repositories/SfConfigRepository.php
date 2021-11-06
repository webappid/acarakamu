<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfConfigRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:33
 * Time: 2021/11/06
 * Class SfConfigRepository
 * @package App\Repositories
 */
class SfConfigRepository 
{
    use SfConfigRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
