<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:12
 * Time: 2022/09/14
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
