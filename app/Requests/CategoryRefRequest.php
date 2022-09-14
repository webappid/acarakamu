<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:03:58
 * Time: 2022/09/14
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
