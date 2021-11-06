<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:03:57
 * Time: 2021/11/06
 * Class AdsRefPriceRequest
 * @package App\Requests
 */

class AdsRefPriceRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'adsPriceRefCode' => 'required|max:10|string',
            'adsPriceRefValue' => 'required|numeric',
            'adsPriceRefClick' => 'required|int',
            'adsPriceRefDateChange' => 'required|max:100|string',
            'adsPriceRefUserId' => 'required|int'
        ];
    }
}
