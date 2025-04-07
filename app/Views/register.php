<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Register<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="register-page">
    <div class="box">
        <div class="field">
            <h2 class="title is-2 has-text-centered">Register</h2>
        </div>

        <form action="/register/save" method="post">
            <?= csrf_field() ?>

            <div class="field">
                <div class="control">
                    <input class="input" id="name" name="name" placeholder="Name" required value="<?= old('name') ?>">
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <input class="input" id="email" name="email" placeholder="Email Address" required>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <input class="input" id="username" name="username" placeholder="Username" required>
                </div>

                <!-- Error message -->
                <?php if (session('errors.username')): ?>
                    <span style="color: red;"><?= session('errors.username') ?></span>
                <?php endif; ?>
            </div>

            <div class="field">
                <div class="control">
                    <input type="password" class="input" id="password" name="password" placeholder="Password" required>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox">
                        I agree to the <a href="#">terms and conditions</a>
                    </label>
                </div>
            </div>

            <div class="field">
                <button class="button is-link is-fullwidth mb-1" type="submit">Submit</button>
                <a class="button is-link is-light is-fullwidth" href="/login">Back to Login</a>
            </div>
        </form>
    </div>
</div>

<style>
    .register-page {
        height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box {
        width: 100%;
        max-width: 320px;
    }
</style>

<?= $this->endSection(); ?>