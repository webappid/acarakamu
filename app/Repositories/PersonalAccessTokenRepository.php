<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\PersonalAccessTokenRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:18
 * Time: 2022/09/14
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
