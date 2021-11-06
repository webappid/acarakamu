<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfGroupRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:34
 * Time: 2021/11/06
 * Class SfGroupRepository
 * @package App\Repositories
 */
class SfGroupRepository 
{
    use SfGroupRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
