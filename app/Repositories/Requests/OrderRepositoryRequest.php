<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:04:13
 * Time: 2022/09/14
 * Class OrderRepositoryRequest
 * @package App\Repositories\Requests
 */
class OrderRepositoryRequest
{
    
    /**
     * @var string
     */
    public $orderNumber;
                
        
    /**
     * @var int
     */
    public $orderOrderStatus;
                
        
    /**
     * @var int
     */
    public $orderMemberId;
                
        
    /**
     * @var int
     */
    public $orderQty;
                
        
    /**
     * @var float
     */
    public $orderCost;
                
        
    /**
     * @var string
     */
    public $orderDateTimeLimit;
                
        
    /**
     * @var string
     */
    public $orderDateTimeChange;
                
        
    /**
     * @var int
     */
    public $orderUserId;
                
}
