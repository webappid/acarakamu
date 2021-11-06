<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:12
 * Time: 2021/11/06
 * Class FailedJobRequest
 * @package App\Requests
 */

class FailedJobRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'uuid' => 'required|max:255|string',
            'connection' => 'required|max:65535|string',
            'queue' => 'required|max:65535|string',
            'payload' => 'required|max:4294967295|string',
            'exception' => 'required|max:4294967295|string',
            'failed_at' => 'required|max:100|string'
        ];
    }
}
