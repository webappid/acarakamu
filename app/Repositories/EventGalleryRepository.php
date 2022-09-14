<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventGalleryRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:01
 * Time: 2022/09/14
 * Class EventGalleryRepository
 * @package App\Repositories
 */
class EventGalleryRepository 
{
    use EventGalleryRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
