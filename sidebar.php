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
    <div class="sidebar border border-dark mt-4 rounded">
        <h6 class="bg-dark px-3 mb-1 pb-2 pt-2 text-white">
            <span>Questions</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo isset($q3) ? 'active':'' ?>" href="./q3.php">
                    <span data-feather="help-circle"></span>
                    Question 3
                    <!-- List all the student and Book name, Author issued on a specific date -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($q4) ? 'active':'' ?>" href="./q4.php">
                    <span data-feather="help-circle"></span>
                    Question 4
                    <!-- List the details of students who borrowed book whose author is Tanenbum -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($q5) ? 'active':'' ?>" href="./q5.php">
                    <span data-feather="help-circle"></span>
                    Question 5
                    <!-- Give a count of how many books have been borrowed by each student -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($q6) ? 'active':'' ?>" href="./q6.php">
                    <span data-feather="help-circle"></span>
                    Question 6
                    <!-- List the students who reached the borrowed limit 3 -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($q7) ? 'active':'' ?>" href="./q7.php">
                    <span data-feather="help-circle"></span>
                    Question 7
                    <!-- Give a list of books taken by student with stud_no C033002 -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($q8) ? 'active':'' ?>" href="./q8.php">
                    <span data-feather="help-circle"></span>
                    Question 8
                    <!-- List the book details which are issued as of today. -->
                </a>
            </li>
        </ul>
    </div>
</nav>
