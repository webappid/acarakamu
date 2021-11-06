<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:04
 * Time: 2021/11/06
 * Class CategoryRefRequest
 * @package App\Requests
 */

class CategoryRefRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'categoryNama' => 'required|max:50|string',
            'categoryImageId' => 'nullable|int',
            'categoryIcon' => 'required|max:100|string',
            'categoryStatusAktif' => 'required|max:5|string',
            'categoryDateChange' => 'required|max:100|string',
            'categoryOrderBy' => 'required|int',
            'categoryUserId' => 'required|int'
        ];
    }
}
