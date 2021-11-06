<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Responses;

/**
 * @author: 
 * Date: 14:04:21
 * Time: 2021/11/06
 * Class OrderDetailRepositoryRequest
 * @package App\Responses
 */
class OrderDetailResponse
{
    
    /**
     * @var int
     */
    public $orderDetailId;
                
        
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
