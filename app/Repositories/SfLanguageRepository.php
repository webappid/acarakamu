<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfLanguageRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:30
 * Time: 2022/09/14
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
