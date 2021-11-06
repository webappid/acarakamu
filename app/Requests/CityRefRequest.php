<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:05
 * Time: 2021/11/06
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
