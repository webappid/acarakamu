<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:38
 * Time: 2021/11/06
 * Class SfLabelRequest
 * @package App\Requests
 */

class SfLabelRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'languageId' => 'nullable|int',
            'modulId' => 'nullable|int',
            'labelName' => 'nullable|max:20|string',
            'labelValue' => 'nullable|max:65535|string',
            'userId' => 'nullable|int',
            'dateInsert' => 'nullable|max:100|string',
            'dateChange' => 'nullable|max:100|string',
            'publish' => 'nullable|max:3|string',
            'status' => 'nullable|max:3|string'
        ];
    }
}
