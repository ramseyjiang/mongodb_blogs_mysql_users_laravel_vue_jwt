<?php

namespace Figtest\Interfaces;

interface LogInterface
{
    public function createTaskLog(object $user, string $desc);
}