<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
 * Class EventHistoryServiceRequest
 * @package App\Services\Requests
 */
class EventHistoryServiceRequest
{
    
    /**
     * @var int
     */
    public $eventHitoryEventId;
                
        
    /**
     * @var int
     */
    public $eventHistoryStatusId;
                
        
    /**
     * @var string
     */
    public $eventHistoryMessage;
                
        
    /**
     * @var string
     */
    public $eventHistoryDateTime;
                
        
    /**
     * @var int
     */
    public $eventHistoryUserId;
                
}
