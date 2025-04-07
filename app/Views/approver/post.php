<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Post Detail<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= view('components/notification'); ?>

<div class="container">
    <?php if ($post['post_status'] === 'Need Revision 1' || $post['post_status'] === 'Need Revision 2') : ?>

        <h2 class="title is-2">Revision Post Form</h2>
        <hr>

        <table class="table is-bordered is-hoverable">
            <thead>
                <tr>
                    <th>Step</th>
                    <th class="has-text-centered">Approver Name</th>
                    <th class="has-text-centered">Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Approver 1</td>
                    <td class="has-text-centered"><?= esc($approver1) ?? 'Waiting for approval'; ?></td>
                    <td class="has-text-centered"><?= $post['status_1'] ?? 'Waiting for status'; ?></td>
                </tr>

                <tr>
                    <td>Approver 2</td>
                    <td class="has-text-centered"><?= esc($approver2) ?? 'Waiting for approval'; ?></td>
                    <td class="has-text-centered"><?= $post['status_2'] ?? 'Waiting for status'; ?></td>
                </tr>
            </tbody>
        </table>

        <div class="notification is-warning is-light">
            <i class="fas fa-info-circle"></i>
            After the approver checks your post, you need some <strong>revisions</strong>. Make changes and resubmit for the approver to check.
        </div>

        <hr>

        <form action="<?= base_url('approver/posts/action/' . $post['slug']); ?>" method="post">
            <?= csrf_field(); ?>

            <div class="field">
                <label class="label" for="title">Title</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Title" name="title" value="<?= esc($post['title']); ?>">
                </div>
            </div>

            <div class="field">
                <label class="label" for="title">Author</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Author" name="author" value="<?= esc($post['author']); ?>">
                </div>
            </div>

            <div class="field">
                <label class="label" for="title">Body</label>
                <div class="control">
                    <input class="textarea" type="text" placeholder="Body" name="body" value="<?= esc($post['body']); ?>">
                </div>
            </div>

            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <a class="button is-light" href="/approver/posts">Back</a>
                </div>
                <div class="control">
                    <button class="button is-link" type="submit" name="action" value="submit">Submit</button>
                </div>
            </div>
        </form>

    <?php else : ?>

        <h2 class="title is-2 "><?= $post['title']; ?></h2>
        <p class="subtitle is-6">By <?= $post['author']; ?></p>
        <hr>

        <table class="table is-bordered is-hoverable">
            <thead>
                <tr>
                    <th>Step</th>
                    <th class="has-text-centered">Approver Name</th>
                    <th class="has-text-centered">Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Approver 1</td>
                    <td class="has-text-centered"><?= esc($approver1) ?? 'Waiting for approval'; ?></td>
                    <td class="has-text-centered"><?= $post['status_1'] ?? 'Waiting for status'; ?></td>
                </tr>

                <tr>
                    <td>Approver 2</td>
                    <td class="has-text-centered"><?= esc($approver2) ?? 'Waiting for approval'; ?></td>
                    <td class="has-text-centered"><?= $post['status_2'] ?? 'Waiting for status'; ?></td>
                </tr>
            </tbody>
        </table>

        <hr>

        <p class="subtitle is-6" style="text-align: justify;"><?= $post['body']; ?></p>

    <?php endif; ?>
</div>

<?= $this->endSection(); ?>