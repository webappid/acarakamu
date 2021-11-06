<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:39
 * Time: 2021/11/06
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
