<?php

namespace App;

interface RepositoryInterface
{
    public function all();
    public function find($id);
}
