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
        // Check if the user is authenticated
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        $id = auth()->user()->id;

        $singleUser = $this->db->query("SELECT * FROM users WHERE id = '$id'")->getFirstRow();

        // var_dump($singleUser);

        return view('users/update-profile', compact('singleUser'));

    }

    public function submitUpdateProfile()
    {

        // Check if the user is authenticated
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

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

    public function updateCV()
    {

        // Check if the user is authenticated
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        return view('users/update-cv');
    }


    public function submitUpdateCV()
    {

        // Check if the user is authenticated
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        $id = auth()->user()->id;
        $file = $this->request->getFile('cv');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'No file uploaded or file is invalid.');
        }

        $file->move('public/assets/cvs');
        $fileName = $file->getClientName();

        $UpdateCV = $this->db->query("UPDATE users SET cv='$fileName' WHERE id = '$id'");

        if ($UpdateCV) {
            return redirect()->to(base_url('users/update-cv/'))->with('update', 'CV Updated successfully!');
        }
    }


    public function userSavedJobs()
    {

        // Check if the user is authenticated
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }


        $id = auth()->user()->id;

        $savedJobs = $this->db->query("SELECT * FROM savedjobs WHERE user_id = '$id'")->getResult();

        // var_dump($singleUser);

        return view('users/saved-jobs', compact('savedJobs'));
    }


    public function userApplyedJobs()
    {

        // Check if the user is authenticated
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        $id = auth()->user()->id;

        $applyedJobs = $this->db->query("SELECT * FROM applyedjobs WHERE user_id = '$id'")->getResult();

        // var_dump($singleUser);

        return view('users/applyed-jobs', compact('applyedJobs'));
    }





}
