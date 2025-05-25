<?php

namespace App\Controllers\Jobs;
use App\Models\Job\Job;

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

        //display related jobs

        $relatedJobs = $this->db->query("SELECT * FROM jobs WHERE id != '$id' AND category ='$singleJob[category]' ORDER BY id DESC LIMIT 5")->getResult();

        //$countRelatedJobs = $this->db->query("SELECT COUNT(*) AS count_jobs FROM jobs WHERE id != '$id' AND category ='$singleJob[category]' ORDER BY id DESC LIMIT 5");

        // var_dump($countRelatedJobs);

        return view('jobs/single-job', compact('singleJob', 'relatedJobs'));
    }
}
