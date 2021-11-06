<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:32
 * Time: 2021/11/06
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
