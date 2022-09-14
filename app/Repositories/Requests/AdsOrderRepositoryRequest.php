<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsOrderRepositoryRequest
 * @package App\Repositories\Requests
 */
class AdsOrderRepositoryRequest
{
    
    /**
     * @var string
     */
    public $adsOrderNumber;
                
        
    /**
     * @var string
     */
    public $adsOrderDateOrder;
                
        
    /**
     * @var int
     */
    public $adsOrderStatusId;
                
        
    /**
     * @var string
     */
    public $adsOrderDateChange;
                
        
    /**
     * @var int
     */
    public $adsOrderQty;
                
        
    /**
     * @var float
     */
    public $adsOrderTotal;
                
        
    /**
     * @var int
     */
    public $adsOrderUserId;
                
}
