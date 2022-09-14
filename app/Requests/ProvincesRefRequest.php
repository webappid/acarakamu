<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:19
 * Time: 2022/09/14
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
