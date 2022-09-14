<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 16:04:07
 * Time: 2022/09/14
 * Class FailedJobServiceRequest
 * @package App\Services\Requests
 */
class FailedJobServiceRequest
{
    
    /**
     * @var string
     */
    public $uuid;
                
        
    /**
     * @var string
     */
    public $connection;
                
        
    /**
     * @var string
     */
    public $queue;
                
        
    /**
     * @var string
     */
    public $payload;
                
        
    /**
     * @var string
     */
    public $exception;
                
        
    /**
     * @var string
     */
    public $failedAt;
                
}
