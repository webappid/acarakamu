<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
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
