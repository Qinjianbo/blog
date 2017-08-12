<?php

namespace App\MyTraits;

use Illuminate\Support\Collection;

trait Helper
{
    /**
     * result
     *
     * @param Collection $data
     * @param int $code
     * @param string $message
     *
     * @access public
     *
     * @return Collection
     */
    public function result(Collection $data, $message = '', int $code = 0) : Collection
    {
        return collect([
            'code' => $code,
            'msg'  => $message,
            'data' => $data
        ]);
    }
}
