<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:23
 * Time: 2021/11/06
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
