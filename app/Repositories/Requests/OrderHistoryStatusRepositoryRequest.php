<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 14:04:22
 * Time: 2021/11/06
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
