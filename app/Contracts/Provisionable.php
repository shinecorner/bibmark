<?php

namespace App\Contracts;

interface Provisionable
{
    public function getPosts(string $tag = 'bibmark', array $options = []);
}