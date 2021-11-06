<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\PersonalAccessTokenRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:27
 * Time: 2021/11/06
 * Class PersonalAccessTokenRepository
 * @package App\Repositories
 */
class PersonalAccessTokenRepository 
{
    use PersonalAccessTokenRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
