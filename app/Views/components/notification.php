<div class="notification-container">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="notification is-success is-light fade-in">
            <button class="delete"></button>
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="notification is-danger is-light fade-in">
            <button class="delete"></button>
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')) : ?>
        <div class="notification is-info is-light fade-in">
            <button class="delete"></button>
            <?= session()->getFlashdata('info'); ?>
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.notification').forEach(notification => {
            setTimeout(() => {
                notification.classList.add('visible');
            }, 100);
        });

        setTimeout(() => {
            document.querySelectorAll('.notification').forEach(notification => {
                notification.classList.remove('visible');
                setTimeout(() => {
                    notification.remove();
                }, 500);
            });
        }, 3000);

        document.querySelectorAll('.notification .delete').forEach($delete => {
            const $notification = $delete.parentNode;
            $delete.addEventListener('click', () => {
                $notification.classList.remove('visible');
                setTimeout(() => {
                    $notification.remove();
                }, 500);
            });
        });
    });
</script>

<style>
    .notification-container {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 400px;
        z-index: 9999;
    }

    .notification {
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }

    .notification.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-out,
    .notification:not(.visible) {
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.5s ease-in, transform 0.5s ease-in;
    }
</style>