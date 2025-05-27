<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function publicProfile()
    {
        $id = auth()->user()->id;
        $singleUser = $this->db->query("SELECT * FROM users WHERE id = '$id'")->getFirstRow();

        // var_dump($singleUser);

        return view('users/public-profile', compact('singleUser'));
    }
}
