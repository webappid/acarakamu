<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\EventMemberLikeRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:09
 * Time: 2021/11/06
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
