<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:42
 * Time: 2021/11/06
 * Class SfMenuLanguageRequest
 * @package App\Requests
 */

class SfMenuLanguageRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'languageId' => 'nullable|int',
            'menuId' => 'nullable|int',
            'displayMenu' => 'nullable|max:30|string'
        ];
    }
}
