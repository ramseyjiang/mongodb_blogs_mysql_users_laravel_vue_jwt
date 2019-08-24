<?php

namespace Figtest\Interfaces;

interface BlogInterface
{
    public function getAll();

    public function getOne(string $blogId);

    public function createBlog(array $data, object $user);

    public function updateBlog(array $data, object $blog);
}