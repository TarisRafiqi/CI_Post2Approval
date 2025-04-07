<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Posts List<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h2 class="title is-2">Posts List</h2>
    <hr>

    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th class="has-text-centered">Author</th>
                <th class="has-text-centered">Status</th>
                <th class="has-text-centered">Progress</th>
                <th class="has-text-centered">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td class="is-narrow has-text-centered is-vcentered" scope="row"><?= $no++; ?></td>
                    <td><?= esc($post['title']); ?></td>
                    <td class="has-text-centered is-vcentered"><?= esc($post['author']); ?></td>
                    <td class="has-text-centered is-vcentered"><?= $post['post_status']; ?></td>
                    <td class="has-text-centered is-vcentered">
                        <progress class="progress is-link is-small" value="<?= $post['progress']; ?>" max="100">
                            <?= $post['progress']; ?>%
                        </progress>
                    </td>
                    <td class="is-narrow has-text-centered is-vcentered">
                        <a class="button is-small" href="/admin/posts/<?= $post['slug']; ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>