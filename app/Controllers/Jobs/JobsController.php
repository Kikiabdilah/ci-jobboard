<?php

namespace App\Controllers\Jobs;
use App\Models\Job\Job;
use App\Models\Category\Category;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JobsController extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function singleJob($id)
    {
        $job = new Job();
        $singleJob = $job->find($id);

        $categories = new Category();

        //display related jobs

        $relatedJobs = $this->db->query("SELECT * FROM jobs WHERE id != '$id' AND category ='$singleJob[category]' ORDER BY id DESC LIMIT 5")->getResult();

        $numRelatedJobs = $this->db->table("jobs")->where('id!=', $id)
            ->where('category', $singleJob['category'])->countAllResults();

        //categories
        $allCategories = $categories->findAll();


        return view('jobs/single-job', compact('singleJob', 'relatedJobs', 'numRelatedJobs', 'allCategories'));
    }

    public function category($name)
    {

        $jobsByCategory = $this->db->query("SELECT * FROM jobs WHERE category ='$name'  ORDER BY id DESC")->getResult();

        $numJobs = $this->db->table("jobs")->where('category', $name)
            ->countAllResults();

        return view('jobs/jobs-category', compact('jobsByCategory', 'numJobs', 'name'));

    }



}
