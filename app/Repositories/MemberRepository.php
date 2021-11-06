<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\MemberRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:16
 * Time: 2021/11/06
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
