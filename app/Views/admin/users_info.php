<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Users List<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h2 class="title is-2">Users List</h2>
    <hr>

    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th class="has-text-centered">Username</th>
                <th class="has-text-centered">Role</th>
                <th class="has-text-centered">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td class="is-narrow has-text-centered is-vcentered" scope="row"><?= $no++; ?></td>
                    <td><?= esc($user['name']); ?></td>
                    <td class="has-text-centered"><?= esc($user['username']); ?></td>
                    <td class="has-text-centered"><?= esc($user['role']); ?></td>
                    <td class="is-narrow has-text-centered is-vcentered">
                        <a class="button is-small" href="/admin/user_detail_info/<?= $user['id']; ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>