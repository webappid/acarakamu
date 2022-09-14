<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Responses;

/**
 * @author: 
 * Date: 16:04:07
 * Time: 2022/09/14
 * Class FailedJobRepositoryRequest
 * @package App\Responses
 */
class FailedJobResponse
{
    
    /**
     * @var int
     */
    public $id;
                
        
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
