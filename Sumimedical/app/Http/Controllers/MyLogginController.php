<?php
namespace App\Http\Controllers;

class MyLogginController extends Controller
{
    public function login()
    {
        $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required'
        ]);
    }
}
?>