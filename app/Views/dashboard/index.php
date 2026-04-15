<section>
    <div class="page-head">
        <div>
            <h2>Dashboard</h2>
            <p class="muted">Quick campus overview and recent activity.</p>
        </div>
    </div>
    <div class="stats-grid">
        <div class="card"><h3><?= e((string) $stats['departments']) ?></h3><p>Departments</p></div>
        <div class="card"><h3><?= e((string) $stats['faculty']) ?></h3><p>Faculty</p></div>
        <div class="card"><h3><?= e((string) $stats['students']) ?></h3><p>Students</p></div>
        <div class="card"><h3><?= e((string) $stats['courses']) ?></h3><p>Courses</p></div>
        <div class="card"><h3><?= e((string) $stats['pending_fees']) ?></h3><p>Pending Fees</p></div>
        <div class="card"><h3>INR <?= e(number_format($stats['collected_fees'], 2)) ?></h3><p>Collected Fees</p></div>
    </div>
    <div class="two-col">
        <div class="card">
            <h3>Recent Attendance</h3>
            <table>
                <thead><tr><th>Date</th><th>Student</th><th>Course</th><th>Status</th></tr></thead>
                <tbody>
                <?php foreach ($recentAttendance as $row): ?>
                    <tr>
                        <td><?= e($row['date']) ?></td>
                        <td><?= e($row['student_name']) ?></td>
                        <td><?= e($row['course_title']) ?></td>
                        <td><span class="badge <?= e($row['status']) ?>"><?= e(ucfirst($row['status'])) ?></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card">
            <h3>Recent Results</h3>
            <table>
                <thead><tr><th>Exam</th><th>Student</th><th>Marks</th><th>Grade</th></tr></thead>
                <tbody>
                <?php foreach ($recentResults as $row): ?>
                    <tr>
                        <td><?= e($row['exam_title']) ?></td>
                        <td><?= e($row['student_name']) ?></td>
                        <td><?= e((string) $row['marks']) ?></td>
                        <td><?= e($row['grade']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
