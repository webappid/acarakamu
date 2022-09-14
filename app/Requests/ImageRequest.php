<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:08
 * Time: 2022/09/14
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
