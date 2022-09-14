<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
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
