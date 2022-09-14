<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
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
