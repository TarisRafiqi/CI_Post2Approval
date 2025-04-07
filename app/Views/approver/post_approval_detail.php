<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Post Approval Detail<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= view('components/notification'); ?>

<div class="container">
    <h2 class="title is-2">Post Detail</h2>
    <hr>
</div>

<?= $this->endSection(); ?>