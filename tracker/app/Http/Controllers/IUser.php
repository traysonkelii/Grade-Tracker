<?php

namespace App\Http\Controllers;

interface IUser{
    public function login();
    public function logout();
    public function getStatus();
    public function getSelf();
}