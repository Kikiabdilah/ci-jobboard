<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content'); ?>





<section class="site-section">
    <div class="container">

        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="section-title mb-2">We Have <?= $numJobs ?> Jobs in <?= $name ?> Category</h2>
            </div>
        </div>

        <ul class="job-listings mb-5">
            <?php foreach ($jobsByCategory as $jobs): ?>
                <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                    <a href="<?php echo url_to('single.job', $jobs->id); ?>"></a>
                    <div class="job-listing-logo">
                        <img src="<?= base_url('public/assets/images/' . $jobs->company_image . ''); ?>"
                            alt="Free Website Template by Free-Template.co" class="img-fluid">
                    </div>

                    <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                        <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                            <h2><?= $jobs->title; ?></h2>
                            <strong><?= $jobs->company_name; ?></strong>
                        </div>
                        <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                            <span class="icon-room"></span> <?= $jobs->location; ?>
                        </div>
                        <div class="job-listing-meta">
                            <span class="badge badge-danger"><?= $jobs->job_type; ?></span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</section>

<?= $this->endSection(); ?>