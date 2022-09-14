<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:36
 * Time: 2022/09/14
 * Class SfMicroprocessProcessRequest
 * @package App\Requests
 */

class SfMicroprocessProcessRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'microprocessProcessMicroprocessId' => 'required|int',
            'microprocessProcessOrder' => 'required|int',
            'microprocessProcessProcessId' => 'nullable|int',
            'microprocessProcessNext' => 'required|max:6|string',
            'microprocessProcessJumpProcess' => 'nullable|int',
            'microprocessProcessJoin' => 'nullable|max:11|string',
            'microprocessProcessLinkId' => 'nullable|int',
            'microprocessProcessKeyId' => 'nullable|int',
            'microprocessProcessForeignId' => 'nullable|int',
            'microprocessProcessEmpty' => 'nullable|max:5|string',
            'microprocessProcessFalseCode' => 'nullable|max:5|string',
            'microprocessProcessFalseMessage' => 'nullable|max:65535|string',
            'microprocessProcessTrueCode' => 'nullable|max:5|string',
            'microprocessProcessTrueMessage' => 'nullable|max:65535|string'
        ];
    }
}
