<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Post Approval Detail<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= view('components/notification'); ?>

<div class="container">
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
                <td class="has-text-centered"><?= ($approver1) ?? 'Waiting for approval'; ?></td>

                <td>
                    <form action="<?= base_url('approver/updateStatus/' . $post['slug']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <div class="select is-small is-fullwidth">
                                    <select name="status_1" <?= ($post['post_status'] !== 'Waiting Approval 1') ? 'disabled' : '' ?>>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Approved" <?= ($post['status_1'] === 'Approved') ? 'selected' : '' ?>>Approved</option>
                                        <option value="Need Revision" <?= ($post['status_1'] === 'Need Revision') ? 'selected' : '' ?>>Need Revision</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control">
                                <button type="submit" name="submit_status_1" class="button is-link is-small" <?= ($post['post_status'] !== 'Waiting Approval 1') ? 'disabled' : '' ?>>Submit</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>

            <tr>
                <td>Approver 2</td>
                <td class="has-text-centered"><?= ($approver2) ?? 'Waiting for approval'; ?></td>
                <td class="has-text-centered"><?= $post['status_2'] ?? 'Waiting for status'; ?></td>
            </tr>
        </tbody>
    </table>

    <hr>
    <p class="subtitle is-6" style="text-align: justify;"><?= $post['body']; ?></p>
</div>

<?= $this->endSection(); ?>