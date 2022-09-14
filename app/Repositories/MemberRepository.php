<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\MemberRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:09
 * Time: 2022/09/14
 * Class MemberRepository
 * @package App\Repositories
 */
class MemberRepository 
{
    use MemberRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
