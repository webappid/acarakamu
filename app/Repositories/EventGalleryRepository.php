<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventGalleryRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:07
 * Time: 2021/11/06
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
