<?php

namespace App\Models\Blog;

use App\Models\Model;
use Illuminate\Support\Collection;
use Illuminate\Mail\Markdown;

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

    /**
     * createMine
     *
     * @param Collection $input
     *
     * @access public
     *
     * @return mixed
     */
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

    public function updateMine(Collection $input)
    {
        return self::update($input->only([
                'title',
                'content',
                'description',
                'type'
            ])->toArray());
    }

    /**
     * list
     *
     * @param Collection $input
     *
     * @access public
     *
     * @return mixed
     */
    public function list(Collection $input)
    {
        return self::select(explode(',', $input->get('select', '*')))
            ->when($input->has('user_id'), function ($blog) use ($input) {
                return $blog->where('user_id', $input->get('user_id'));
            })
            ->orderBy('created_at', 'desc')
            ->offset(($input->get('page', 1) - 1) * $input->get('size', 12))
            ->limit($input->get('size', 12))
            ->get();
    }

    /**
     * count
     *
     * @param Collection $input
     *
     * @access public
     *
     * @return mixed
     */
    public function count(Collection $input)
    {
        return self::when($input->has('user_id'), function ($blog) use ($input) {
            return $blog->where('user_id', $input->get('user_id'));
        })
            ->count();
    }

    /**
     * show
     *
     * @param Collection $input
     * @param int $id
     *
     * @return Collection
     */
    public function show(Collection $input, int $id) : Collection
    {
        return collect(self::when($input->has('user_id'), function ($blog) use ($input) {
            return $blog->where('user_id', $input->get('user_id'));
        })
            ->where('id', $id)
            ->first())
            ->pipe(function ($blog) {
                $blog['content'] = Markdown::parse($blog['content']);
                
                return $blog;
            });
    }
}
