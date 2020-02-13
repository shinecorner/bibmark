<?php

namespace App\Contracts;

interface Provisionable
{
    public function getPosts(array $tags = ['bibmark'], array $options = []);
}