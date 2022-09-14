<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:04:14
 * Time: 2022/09/14
 * Class OrderDetailServiceRequest
 * @package App\Services\Requests
 */
class OrderDetailServiceRequest
{
    
    /**
     * @var int
     */
    public $orderDetailOrderId;
                
        
    /**
     * @var int
     */
    public $orderDetailEventId;
                
        
    /**
     * @var int
     */
    public $orderDetailQty;
                
        
    /**
     * @var float
     */
    public $orderDetailEventCost;
                
        
    /**
     * @var string
     */
    public $orderDetailDateChange;
                
}
