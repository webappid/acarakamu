<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:23
 * Time: 2022/09/14
 * Class SfAccessRefRequest
 * @package App\Requests
 */

class SfAccessRefRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'accessName' => 'nullable|max:20|string'
        ];
    }
}
