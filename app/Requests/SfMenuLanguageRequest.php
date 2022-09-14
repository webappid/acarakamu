<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:32
 * Time: 2022/09/14
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
