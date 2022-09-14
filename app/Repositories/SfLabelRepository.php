<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfLabelRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:28
 * Time: 2022/09/14
 * Class SfLabelRepository
 * @package App\Repositories
 */
class SfLabelRepository 
{
    use SfLabelRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
