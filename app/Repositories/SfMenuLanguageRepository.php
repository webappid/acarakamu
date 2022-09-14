<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Repositories\SfMenuLanguageRepositoryTrait;

/**
 * @author: 
 * Date: 16:04:32
 * Time: 2022/09/14
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
