<section>
    <div class="page-head"><div><h2>Attendance</h2><p class="muted">Track daily course attendance.</p></div></div>
    <div class="card form-card">
        <h3>Mark attendance</h3>
        <form method="POST" action="/attendance/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Student</span><select name="student_id"><?php foreach ($students as $student): ?><option value="<?= e((string) $student['id']) ?>"><?= e($student['name']) ?></option><?php endforeach; ?></select></label>
            <label><span>Course</span><select name="course_id"><?php foreach ($courses as $course): ?><option value="<?= e((string) $course['id']) ?>"><?= e($course['title']) ?></option><?php endforeach; ?></select></label>
            <label><span>Date</span><input type="date" name="date" value="<?= e(date('Y-m-d')) ?>" required></label>
            <label><span>Status</span><select name="status"><option value="present">Present</option><option value="absent">Absent</option><option value="late">Late</option></select></label>
            <button type="submit">Save attendance</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Date</th><th>Student</th><th>Course</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['date']) ?></td><td><?= e($item['student_name']) ?></td><td><?= e($item['course_title']) ?></td><td><span class="badge <?= e($item['status']) ?>"><?= e(ucfirst($item['status'])) ?></span></td>
                    <td><form method="POST" action="/attendance/delete" onsubmit="return confirm('Delete this attendance entry?');"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e((string) $item['id']) ?>"><button type="submit" class="danger">Delete</button></form></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
