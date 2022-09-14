<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:30
 * Time: 2022/09/14
 * Class SfLanguageRequest
 * @package App\Requests
 */

class SfLanguageRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'languageName' => 'nullable|max:20|string',
            'dateChange' => 'nullable|max:100|string',
            'userId' => 'nullable|int'
        ];
    }
}
