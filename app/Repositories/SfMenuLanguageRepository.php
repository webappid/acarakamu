<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMenuLanguageRepositoryTrait;

/**
 * @author: 
 * Date: 14:04:42
 * Time: 2021/11/06
 * Class SfMenuLanguageRepository
 * @package App\Repositories
 */
class SfMenuLanguageRepository 
{
    use SfMenuLanguageRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
