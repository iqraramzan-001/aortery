<?php

namespace App\Http\Interfaces;

interface CartInterface
{

    public function index();

    public function detail($id);

    public function delete($id);


    public function store(array $data);


}
