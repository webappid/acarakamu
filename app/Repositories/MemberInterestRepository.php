<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\MemberInterestRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:11
 * Time: 2022/09/14
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
