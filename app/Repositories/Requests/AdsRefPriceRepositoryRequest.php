<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:03:56
 * Time: 2021/11/06
 * Class AdsRefPriceRepositoryRequest
 * @package App\Repositories\Requests
 */
class AdsRefPriceRepositoryRequest
{
    
    /**
     * @var string
     */
    public $adsPriceRefCode;
                
        
    /**
     * @var float
     */
    public $adsPriceRefValue;
                
        
    /**
     * @var int
     */
    public $adsPriceRefClick;
                
        
    /**
     * @var string
     */
    public $adsPriceRefDateChange;
                
        
    /**
     * @var int
     */
    public $adsPriceRefUserId;
                
}
