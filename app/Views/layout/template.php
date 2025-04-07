<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <?= $this->include('layout/navbar') ?>

    <div class="layout">
        <!-- Sidebar -->
        <?php if (!in_array(uri_string(), ['', 'login', 'register'])): ?>
            <?= $this->include('layout/sidebar') ?>
        <?php endif; ?>

        <!-- Main Content -->
        <main class="content">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

</body>

</html>

<style>
    html {
        height: 100%;
    }

    body {
        padding-top: 3.5em;
    }

    .layout {
        display: flex;
        min-height: 100vh;
    }

    .content {
        flex-grow: 1;
        /* Biar konten menyesuaikan lebar sisanya */
        padding: 20px;
    }
</style>