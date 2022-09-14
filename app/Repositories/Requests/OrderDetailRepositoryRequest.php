<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:04:14
 * Time: 2022/09/14
 * Class OrderDetailRepositoryRequest
 * @package App\Repositories\Requests
 */
class OrderDetailRepositoryRequest
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
