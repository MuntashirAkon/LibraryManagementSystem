<style>
    .feather {
        vertical-align: text-bottom;
    }
    .sidebar .nav-link {
        color: #333;
    }
    .sidebar .feather {
        color: #999;
        height: 16px;
        width: 16px;
    }
    #title .feather {
        vertical-align: unset;
    }
    .sidebar .active {
        background-color: peachpuff;
    }
</style>
<nav class="col-md-3 d-none d-md-block">
    <div class="sidebar border border-dark mt-4 rounded">
        <h6 class="bg-dark px-3 mb-1 pb-2 pt-2 text-white">
            <span>Navigate to</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo isset($student_tab) ? 'active':'' ?>" href="./student.php">
                    <span data-feather="users"></span>
                    Students
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($member_tab) ? 'active':'' ?>" href="./member.php">
                    <span data-feather="user-check"></span>
                    Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($book_tab) ? 'active':'' ?>" href="./book.php">
                    <span data-feather="book"></span>
                    Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($issue_tab) ? 'active':'' ?>" href="./issue.php">
                    <span data-feather="bar-chart-2"></span>
                    Issues
                </a>
            </li>
        </ul>
    </div>
</nav>
