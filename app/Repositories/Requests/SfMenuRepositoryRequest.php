<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:04:40
 * Time: 2021/11/06
 * Class SfMenuRepositoryRequest
 * @package App\Repositories\Requests
 */
class SfMenuRepositoryRequest
{
    
    /**
     * @var string
     */
    public $menuName;
                
        
    /**
     * @var string
     */
    public $menuPath;
                
        
    /**
     * @var int
     */
    public $moduleId;
                
        
    /**
     * @var int
     */
    public $parentLink;
                
        
    /**
     * @var string
     */
    public $menuIcon;
                
        
    /**
     * @var int
     */
    public $order;
                
        
    /**
     * @var int
     */
    public $userId;
                
        
    /**
     * @var string
     */
    public $dateChange;
                
}
