<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\ImageRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:15
 * Time: 2021/11/06
 * Class ImageRepository
 * @package App\Repositories
 */
class ImageRepository 
{
    use ImageRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
