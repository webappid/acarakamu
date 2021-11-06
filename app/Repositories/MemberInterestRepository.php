<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\MemberInterestRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:17
 * Time: 2021/11/06
 * Class MemberInterestRepository
 * @package App\Repositories
 */
class MemberInterestRepository 
{
    use MemberInterestRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
