<?php

namespace App\Http\Interfaces;

interface OrderInterface
{

    public function index();
    public function store(array $data);

    public function delete($id);

     public function status(array $data, $id);

    public function updateStatus(array $data, $id);

     public function show($id);

}
