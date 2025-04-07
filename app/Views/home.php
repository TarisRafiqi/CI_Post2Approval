<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Home Page<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<section class="hero is-large container">
    <div class="hero-body">
        <p class="title is-3 mb-3">Post 2 Approval</p>
        <p class="subtitle is-6" style="text-align: justify;">
            This application is a post management and approval system built using CodeIgniter 4.
            Every post created by a user will go through two stages of approval before being declared approved.
            This project implements user authentication, role-based access control management, validation and error handling.
            There are three roles in this application: Admin, Approver, and Writer, each with different access and responsibilities to the content approval flow.
        </p>

        <div class="is-flex custom-align">
            <div class="mr-3">
                <a href="https://github.com/TarisRafiqi/CI_Post2Approval" class="button" target="_blank">
                    <span class="icon"><i class="fab fa-github"></i></span>
                    <span>GitHub</span>
                </a>
            </div>
            <div class="ListIcon">
                <img src="<?= base_url('img/CodeIgniter_Logo.svg') ?>" alt="CodeIgniter Logo">
                <img src="<?= base_url('img/BulmaIcon.svg') ?>" alt="Bulma Logo">
                <i class="fa-brands fa-php" style="color: #000000;"></i>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-align {
        align-items: center;
    }

    .ListIcon {
        display: flex;
        align-items: center;
    }

    .ListIcon i,
    .ListIcon img {
        font-size: 2rem;
        width: 2rem;
        height: 2rem;
    }
</style>

<?= $this->endSection(); ?>