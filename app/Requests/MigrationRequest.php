<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:19
 * Time: 2021/11/06
 * Class MigrationRequest
 * @package App\Requests
 */

class MigrationRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'migration' => 'required|max:255|string',
            'batch' => 'required|int'
        ];
    }
}
