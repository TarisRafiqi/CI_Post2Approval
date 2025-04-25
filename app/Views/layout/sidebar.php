<div class="sidebar">
    <aside class="menu">
        <p class="menu-label">General</p>

        <ul class="menu-list">
            <?php if (session('role') === 'admin'): ?>
                <li><a href="/admin/posts"><span class="icon"><i class="fas fa-list"></i></span>
                        <span class="text">Posts</span></a></li>
                <li><a href="/admin/users_info"><span class="icon"><i class="fas fa-users-cog"></i></span>
                        <span class="text">Users Info</span></a></li>
            <?php elseif (session('role') === 'approver'): ?>
                <li><a href="/approver/posts"><span class="icon"><i class="fas fa-list"></i></span>
                        <span class="text">Posts</span></a></li>
                <li><a href="/approver/posts_approval"><span class="icon"><i class="fa-regular fa-square-check"></i></i></span>
                        <span class="text">Approvals</span></a></li>
                <li><a href="/approver/my_profile"><span class="icon"><i class="fas fa-user"></i></span>
                        <span class="text">Profile</span></a></li>
            <?php elseif (session('role') === 'writer'): ?>
                <li><a href="/writer/posts"><span class="icon"><i class="fas fa-list"></i></span>
                        <span class="text">Posts</span></a></li>
                <li><a href="/writer/my_profile"><span class="icon"><i class="fas fa-user"></i></span>
                        <span class="text">Profile</span></a></li>
            <?php endif; ?>
        </ul>
    </aside>
</div>

<style>
    .sidebar {
        width: 200px;
        padding: 20px;
        min-height: 100vh;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        /* transition: width 0.1s ease-in-out; */
    }

    @media (max-width: 1080px) {
        .sidebar {
            width: 60px;
            padding: 20px 10px;
        }

        .menu-list li a {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menu-list li a .text {
            display: none;
        }

        .menu-label {
            visibility: hidden;
            height: 20px;
        }
    }
</style>