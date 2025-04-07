<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Post Detail<?= $this->endSection(); ?>

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
                <td>
                    <form action="<?= base_url('admin/updateApprover/' . $post['slug']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <div class="select is-small is-fullwidth">
                                    <select name="approver_1">
                                        <option value="" disabled <?= empty($selectedApprover1) ? 'selected' : ''; ?> selected>Select Approver</option>
                                        <?php foreach ($approver1 as $ap1) : ?>
                                            <option value="<?= esc($ap1['id']); ?>"
                                                <?= isset($selectedApprover1) && $selectedApprover1 == $ap1['id'] ? 'selected' : ''; ?>>
                                                <?= esc($ap1['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control">
                                <button type="submit" class="button is-link is-small">Submit</button>
                            </div>
                        </div>
                    </form>
                </td>

                <!-- Approver 1: Status -->
                <td>
                    <form action="<?= base_url('admin/updateStatus/' . $post['slug']); ?>" method="post">
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

            <!-- ===================================================================================== -->

            <tr>
                <td>Approver 2</td>
                <td>
                    <form action="<?= base_url('admin/updateApprover/' . $post['slug']); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <div class="select is-small is-fullwidth">
                                    <select name="approver_2">
                                        <option value="" disabled <?= empty($selectedApprover2) ? 'selected' : ''; ?> selected>Select Approver</option>
                                        <?php foreach ($approver2 as $ap2) : ?>
                                            <option value="<?= esc($ap2['id']); ?>"
                                                <?= isset($selectedApprover2) && $selectedApprover2 == $ap2['id'] ? 'selected' : ''; ?>>
                                                <?= esc($ap2['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control">
                                <button type="submit" class="button is-link is-small">Submit</button>
                            </div>
                        </div>
                    </form>
                </td>

                <!-- Approver 2: Status -->
                <td>
                    <form action="<?= base_url('admin/updateStatus/' . $post['slug']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <div class="select is-small is-fullwidth">
                                    <select name="status_2" <?= ($post['post_status'] !== 'Waiting Approval 2') ? 'disabled' : '' ?>>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Approved" <?= ($post['status_2'] === 'Approved') ? 'selected' : '' ?>>Approved</option>
                                        <option value="Need Revision" <?= ($post['status_2'] === 'Need Revision') ? 'selected' : '' ?>>Need Revision</option>
                                        <option value="Rejected" <?= ($post['status_2'] === 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control">
                                <button type="submit" name="submit_status_2" class="button is-link is-small" <?= ($post['post_status'] !== 'Waiting Approval 2') ? 'disabled' : '' ?>>Submit</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

    <hr>
    <p class="subtitle is-6" style="text-align: justify;"><?= $post['body']; ?></p>
</div>

<?= $this->endSection(); ?>