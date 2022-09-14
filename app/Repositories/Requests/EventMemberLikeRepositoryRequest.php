<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories\Requests;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
 * Class EventMemberLikeRepositoryRequest
 * @package App\Repositories\Requests
 */
class EventMemberLikeRepositoryRequest
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
