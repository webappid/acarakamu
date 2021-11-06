<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfLanguageRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:39
 * Time: 2021/11/06
 * Class SfLanguageRepository
 * @package App\Repositories
 */
class SfLanguageRepository 
{
    use SfLanguageRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
