<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
 * Class EventHistoryRepositoryRequest
 * @package App\Repositories\Requests
 */
class EventHistoryRepositoryRequest
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
