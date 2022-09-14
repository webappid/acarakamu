<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsOrderServiceRequest
 * @package App\Services\Requests
 */
class AdsOrderServiceRequest
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
