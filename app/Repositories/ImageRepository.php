<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\ImageRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:08
 * Time: 2022/09/14
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
