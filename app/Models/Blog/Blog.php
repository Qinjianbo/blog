<?php

namespace App\Models\Blog;

use App\Models\Model;
use Illuminate\Support\Collection;

class Blog extends Model
{
    /**
     * delete
     *
     * @param int $user_id
     * @param int $id
     *
     * @access public
     *
     * @return mixed
     */
    public function deleteMine(int $user_id, int $id)
    {
        return self::where('user_id', $user_id)
            ->where('id', $id)
            ->delete();
    }

    public function createMine(Collection $input)
    {
        return self::create($input->only([
                'title',
                'user_id',
                'content',
                'description',
                'type'
            ])->toArray());
    }
}
