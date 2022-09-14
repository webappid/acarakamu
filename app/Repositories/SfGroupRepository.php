<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfGroupRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:25
 * Time: 2022/09/14
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
