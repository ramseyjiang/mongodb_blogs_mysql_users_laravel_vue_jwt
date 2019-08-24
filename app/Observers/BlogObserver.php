<?php

namespace Figtest\Observers;

use Figtest\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Figtest\Services\LogService;

class BlogObserver
{
    protected $logService;

    public function __construct(LogService $logService) 
    {
        $this->user = Auth::user();
        $this->logService = $logService;
    }

    /**
     * Handle the blog "created" event.
     *
     * @param  \Figtest\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog)
    {
        $this->user = empty($this->user) ? ($blog->user) : $this->user;
        $desc = 'blog ' . $blog->id . ' is created by user '. $this->user->id;
        $this->logService->createBlogLog($this->user, $desc);
    }

    /**
     * Handle the blog "updated" event.
     * The updated events include updated blogs.
     *
     * @param  \Figtest\Models\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        $this->user = empty($this->user) ? ($blog->user) : $this->user;
        $desc = 'blog ' . $blog->id . ' is updated by user '. $this->user->id;
        $this->logService->createBlogLog($this->user, $desc);
    }

    /**
     * Handle the blog "deleted" event.
     *
     * @param  \Figtest\Models\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
        $desc = 'blog ' . $blog->id . ' is deleted by user '. $this->user->id;
        $this->logService->createBlogLog($this->user, $desc);
    }

    /**
     * Handle the blog "restored" event.
     *
     * @param  \Figtest\Models\Blog  $blog
     * @return void
     */
    public function restored(Blog $blog)
    {
        //
    }

    /**
     * Handle the blog "force deleted" event.
     *
     * @param  \Figtest\Models\Blog  $blog
     * @return void
     */
    public function forceDeleted(Blog $blog)
    {
        //
    }
}
