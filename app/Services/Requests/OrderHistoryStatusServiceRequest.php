<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:04:15
 * Time: 2022/09/14
 * Class OrderHistoryStatusServiceRequest
 * @package App\Services\Requests
 */
class OrderHistoryStatusServiceRequest
{
    
    /**
     * @var int
     */
    public $orderHistoryStatusOrderId;
                
        
    /**
     * @var string
     */
    public $orderHistoryStatusDesc;
                
        
    /**
     * @var int
     */
    public $orderHistoryStatusStatusId;
                
        
    /**
     * @var int
     */
    public $orderHistoryStatusUserId;
                
}
