<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:07
 * Time: 2022/09/14
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
