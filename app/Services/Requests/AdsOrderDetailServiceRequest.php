<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
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
