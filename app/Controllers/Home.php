<?php

namespace App\Controllers;
use App\Models\Job\Job;
class Home extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function index(): string
    {

        $jobs = new Job();
        $allJobs = $jobs->findAll();

        $numJobs = $this->db->table("jobs")->countAllResults();


        return view('home', compact('allJobs', 'numJobs'));
    }
}
