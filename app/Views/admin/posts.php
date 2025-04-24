<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>Posts List<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h2 class="title is-2">Posts List</h2>
    <hr>

    <table class="table is-striped is-narrow is-hoverable is-fullwidth" id="posts-table">
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
        <tbody id="posts-body"></tbody>
    </table>

    <script>
        fetch('/admin/api/posts')
            .then(res => res.json())
            .then(res => {
                console.log(res);
                const posts = res.data;
                const tbody = document.getElementById('posts-body');
                let no = 1;
                posts.forEach(post => {
                    const row = `
        <tr>
          <td class="has-text-centered">${no++}</td>
          <td>${post.title}</td>
          <td class="has-text-centered">${post.author}</td>
          <td class="has-text-centered">${post.status_label}</td>
          <td class="has-text-centered">
            <progress class="progress is-link is-small" value="${post.progress}" max="100">
              ${post.progress}%
            </progress>
          </td>
          <td class="has-text-centered">
            <a class="button is-small" href="/admin/posts/${post.slug}">Detail</a>
          </td>
        </tr>
      `;
                    tbody.innerHTML += row;
                });
            });
    </script>

</div>

<?= $this->endSection(); ?>