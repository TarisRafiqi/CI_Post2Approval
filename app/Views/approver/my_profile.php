<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>My Profile<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= view('components/notification'); ?>

<div class="container">
    <h2 class="title is-2">My Profile</h2>
    <hr>

    <form action="<?= base_url('approver/updateUserDetail'); ?>" method="post">
        <?= csrf_field(); ?>

        <div class="field">
            <div class="columns is-vcentered">
                <div class="column is-2">
                    <p><strong>Name</strong></p>
                </div>
                <div class="column"><input class="input" type="text" placeholder="Name" name="name" value="<?= esc($user['name']); ?>"></div>
            </div>

            <div class="columns is-vcentered">
                <div class="column is-2">
                    <p><strong>Username</strong></p>
                </div>
                <div class="column"><input class="input" type="text" placeholder="Username" name="username" value="<?= esc($user['username']); ?>"></div>
            </div>

            <div class="columns is-vcentered">
                <div class="column is-2">
                    <p><strong>Email</strong></p>
                </div>
                <div class="column"><input class="input" type="text" placeholder="Email" name="email" value="<?= esc($user['email']); ?>"></div>
            </div>

            <div class="columns is-vcentered">
                <div class="column is-2">
                    <p><strong>Role</strong></p>
                </div>
                <div class="column"><input class="input" type="text" placeholder="Role" name="role" value="<?= esc($user['role']); ?>" disabled></div>
            </div>
        </div>

        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-link" type="submit" name="action" value="submit">Submit</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>