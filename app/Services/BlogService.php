<?php

namespace Figtest\Services;

use Figtest\Interfaces\BlogInterface;
use Figtest\Models\Blog;
use Carbon\Carbon;

class BlogService implements BlogInterface
{
    public static $isReleased = 1;

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return Blog::where('is_released', self::$isReleased)->orderBy('created_at', 'desc')->get();
    }

    /**
     * @inheritDoc
     */
    public function getOne(string $blogId)
    {
        return Blog::findOrFail($blogId);
    }

    /**
     * @inheritDoc
     */
    public function createBlog(array $data, object $user)
    {
        return Blog::create([
            'name' => $data['name'],
            'desc' => $data['desc'],
            'user_id' => $user->id,
            'is_released' => self::$isReleased
        ]);
    }

    /**
     * @inheritDoc
     */
    public function updateBlog(array $data, object $blog)
    {
        $blog->name = $data['name'];
        $blog->desc = $data['desc'];
        $blog->save();
    }
}
