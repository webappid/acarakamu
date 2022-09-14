<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Class AdsOrderDetailRepositoryRequest
 * @package App\Repositories\Requests
 */
class AdsOrderDetailRepositoryRequest
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
