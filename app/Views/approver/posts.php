<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>My Posts<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h2 class="title is-2">My Posts</h2>
    <hr>

    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th class="has-text-centered">Author</th>
                <th class="has-text-centered">Status</th>
                <th class="has-text-centered">Progress</th>
                <th class="has-text-centered">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td class="is-narrow has-text-centered" scope="row"><?= $no++; ?></td>
                    <td><?= esc($post['title']); ?></td>
                    <td class="has-text-centered"><?= esc($post['author']); ?></td>
                    <td class="has-text-centered"><?= $post['post_status']; ?></td>
                    <td class="has-text-centered is-vcentered">
                        <progress class="progress is-link is-small" value="<?= $post['progress']; ?>" max="100">
                            <?= $post['progress']; ?>%
                        </progress>
                    </td>
                    <td class="is-narrow has-text-centered">
                        <a class="button is-small" href="/approver/posts/<?= $post['slug']; ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>