<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:04:15
 * Time: 2022/09/14
 * Class OrderHistoryStatusRepositoryRequest
 * @package App\Repositories\Requests
 */
class OrderHistoryStatusRepositoryRequest
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
