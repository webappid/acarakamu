<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:15
 * Time: 2021/11/06
 * Class ImageRequest
 * @package App\Requests
 */

class ImageRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'imageName' => 'required|max:255|string',
            'imageDescription' => 'required|max:255|string',
            'imageAlt' => 'required|max:50|string',
            'imageOwnerUserId' => 'required|int',
            'imageDateChange' => 'required|max:100|string',
            'imageUserId' => 'required|int'
        ];
    }
}
