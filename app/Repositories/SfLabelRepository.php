<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfLabelRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:38
 * Time: 2021/11/06
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
