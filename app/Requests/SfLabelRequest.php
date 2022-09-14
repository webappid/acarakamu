<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:28
 * Time: 2022/09/14
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
