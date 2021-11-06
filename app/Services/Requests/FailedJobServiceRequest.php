<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Requests;

/**
 * @author: 
 * Date: 14:04:12
 * Time: 2021/11/06
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
