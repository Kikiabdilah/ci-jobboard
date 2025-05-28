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


    public function publicProfile($id)
    {
        $singleUser = $this->db->query("SELECT * FROM users WHERE id = '$id'")->getFirstRow();

        // var_dump($singleUser);

        return view('users/public-profile', compact('singleUser'));
    }


    public function updateProfile()
    {
        $id = auth()->user()->id;

        $singleUser = $this->db->query("SELECT * FROM users WHERE id = '$id'")->getFirstRow();

        // var_dump($singleUser);

        return view('users/update-profile', compact('singleUser'));
    }

    public function submitUpdateProfile()
    {
        $id = auth()->user()->id;

        $username = $this->request->getPost('username');
        $job_title = $this->request->getPost('job_title');
        $facebook = $this->request->getPost('facebook');
        $linkedin = $this->request->getPost('linkedin');
        $twitter = $this->request->getPost('twitter');
        $bio = $this->request->getPost('bio');

        $updateSingleUser = $this->db->query("UPDATE users SET username='$username', job_title='$job_title', facebook='$facebook', linkedin='$linkedin', twitter='$twitter', bio='$bio' WHERE id = '$id'");

        //var_dump($updateSingleUser);

        if ($updateSingleUser) {
            return redirect()->to(base_url('users/update-profile/'))->with('update', 'Profile Updated successfully!');
        }
    }




}
