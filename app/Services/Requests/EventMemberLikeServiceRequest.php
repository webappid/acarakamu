<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:09
 * Time: 2021/11/06
 * Class EventMemberLikeServiceRequest
 * @package App\Services\Requests
 */
class EventMemberLikeServiceRequest
{
    
    /**
     * @var int
     */
    public $eventMemberLikeEventId;
                
        
    /**
     * @var int
     */
    public $eventMemberLikeMemberId;
                
        
    /**
     * @var int
     */
    public $eventMemberLikeStars;
                
        
    /**
     * @var string
     */
    public $eventMemberLikeDateChange;
                
        
    /**
     * @var int
     */
    public $eventMemberLikeUserId;
                
}
