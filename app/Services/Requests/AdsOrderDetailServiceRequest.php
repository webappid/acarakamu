<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:03:55
 * Time: 2021/11/06
 * Class AdsOrderDetailServiceRequest
 * @package App\Services\Requests
 */
class AdsOrderDetailServiceRequest
{
    
    /**
     * @var int
     */
    public $adsOrderDetailAdsOrderId;
                
        
    /**
     * @var int
     */
    public $adsOrderDetailAdsRefPriceId;
                
        
    /**
     * @var int
     */
    public $adsOrderDetailAdsEventId;
                
        
    /**
     * @var int
     */
    public $adsOrderDetailQty;
                
        
    /**
     * @var float
     */
    public $adsOrderDetailSubTotal;
                
        
    /**
     * @var float
     */
    public $adsOrderDetailTotal;
                
        
    /**
     * @var string
     */
    public $adsOrderDetailDateChange;
                
}
