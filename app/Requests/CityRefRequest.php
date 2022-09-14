<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Class CityRefRequest
 * @package App\Requests
 */

class CityRefRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'cityProvincesRefId' => 'required|int',
            'cityNama' => 'required|max:50|string',
            'cityStatusAktif' => 'required|max:5|string',
            'cityDateChange' => 'required|max:100|string',
            'cityUserId' => 'required|int'
        ];
    }
}
