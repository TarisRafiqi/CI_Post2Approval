<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Post Form<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= view('components/notification'); ?>

<div class="container">
    <h2 class="title is-2">Post Form</h2>
    <hr>

    <form action="<?= site_url('writer/post_form/action') ?>" method="post">
        <?= csrf_field() ?>

        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
                <input class="input" id="title" name="title" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="author">Author</label>
            <div class="control">
                <input class="input" id="author" name="author" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="body">Body</label>
            <div class="control">
                <textarea class="textarea" id="body" name="body" required></textarea>
            </div>
        </div>

        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <div class="control">
                    <a class="button is-light" href="/writer/posts">Back to posts</a>
                </div>
            </div>
            <div class="control">
                <button class="button is-warning" type="submit" name="action" value="draft">Save Draft</button>
            </div>
            <div class="control">
                <button class="button is-link" type="submit" name="action" value="submit">Submit</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>