<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventMemberLikeRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
 * Class EventMemberLikeRepository
 * @package App\Repositories
 */
class EventMemberLikeRepository 
{
    use EventMemberLikeRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
