<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>User Detail<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= view('components/notification'); ?>

<div class="container">
    <h2 class="title is-2">User Detail</h2>
    <hr>

    <form action="<?= base_url('admin/updateUserDetail/' . $user['id']); ?>" method="post">
        <?= csrf_field(); ?>

        <div class="field">
            <div class="columns is-vcentered">
                <div class="column is-2">
                    <p><strong>Username</strong></p>
                </div>
                <div class="column"><input class="input" type="text" placeholder="Username" name="username" value="<?= esc($user['username']); ?>"></div>
            </div>

            <div class="columns is-vcentered">
                <div class="column is-2">
                    <p><strong>Name</strong></p>
                </div>
                <div class="column"><input class="input" type="text" placeholder="Name" name="name" value="<?= esc($user['name']); ?>"></div>
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
                <div class="column">
                    <div class="control">
                        <div class="select">
                            <select name="role">
                                <option value="" disabled>Select role</option>
                                <option value="approver" <?= ($user['role'] == 'approver') ? 'selected' : ''; ?>>Approver</option>
                                <option value="writer" <?= ($user['role'] == 'writer') ? 'selected' : ''; ?>>Writer</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns is-vcentered">
                <div class="column is-2">
                    <p><strong>Account Status</strong></p>
                </div>
                <div class="column">
                    <div class="control">
                        <div class="select">
                            <select name="is_active">
                                <option value="" disabled>Select account status</option>
                                <option value="1" <?= ($user['is_active'] == 1) ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?= ($user['is_active'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <div class="control">
                        <a class="button is-light" href="/admin/users_info">Back</a>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-link" type="submit" name="action" value="submit">Save</button>
                </div>
            </div>
        </div>

    </form>
</div>

<?= $this->endSection(); ?>