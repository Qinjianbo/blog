<?php

namespace App\MyTraits;

use Illuminate\Support\Collection;

trait helper
{
    /**
     * response 
     * 
     * @param int $code 
     * @param mixed $message 
     * @param Collection $data 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function response(Collection $data, int $code = 0, $message = '')
    {
        return collect([
            'code' => $code,
            'msg'  => $message,
            'data' => $data
        ]);
    }
}
