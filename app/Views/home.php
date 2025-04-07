<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Home Page<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<section class="hero is-large container">
    <div class="hero-body">
        <div class="columns">
            <div class="column">
                <p class="title is-3 mb-3">Simple Approval App</p>
                <p class="subtitle is-6" style="text-align: justify;">This project is about post approval where every post
                    that is inputted will be
                    approved
                    by 2 users (admin and approver). Contains CRUD Post, Simple User Setting, Authentication, and
                    Role-Based
                    Access Control.</p>
                <div class="ListIcon is-flex">
                    <i class="fa-brands fa-laravel"></i>
                    <img src="<?= base_url('img/BulmaIcon.svg') ?>" alt="Bulma Logo">

                </div>
            </div>
            <div class="column"></div>
        </div>
    </div>
</section>

<style>
    .ListIcon i,
    .ListIcon img {
        font-size: 2rem;
        width: 2rem;
        height: 2rem;
    }
</style>

<?= $this->endSection(); ?>