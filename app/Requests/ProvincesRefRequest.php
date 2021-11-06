<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:29
 * Time: 2021/11/06
 * Class ProvincesRefRequest
 * @package App\Requests
 */

class ProvincesRefRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'provincesRefNama' => 'required|max:50|string',
            'provincesRefStatusActive' => 'required|max:5|string',
            'provincesRefDateChange' => 'required|max:100|string',
            'provincesRefUserId' => 'required|int'
        ];
    }
}
