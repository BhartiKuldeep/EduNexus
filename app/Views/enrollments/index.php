<section>
    <div class="page-head"><div><h2>Enrollments</h2><p class="muted">Assign students to registered courses.</p></div></div>
    <div class="card form-card">
        <h3>Create enrollment</h3>
        <form method="POST" action="/enrollments/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Student</span><select name="student_id"><?php foreach ($students as $student): ?><option value="<?= e((string) $student['id']) ?>"><?= e($student['name']) ?> (<?= e($student['roll_no']) ?>)</option><?php endforeach; ?></select></label>
            <label><span>Course</span><select name="course_id"><?php foreach ($courses as $course): ?><option value="<?= e((string) $course['id']) ?>"><?= e($course['title']) ?> (<?= e($course['code']) ?>)</option><?php endforeach; ?></select></label>
            <button type="submit">Assign</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Student</th><th>Roll No</th><th>Course</th><th>Code</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['student_name']) ?></td><td><?= e($item['roll_no']) ?></td><td><?= e($item['course_title']) ?></td><td><?= e($item['course_code']) ?></td>
                    <td><form method="POST" action="/enrollments/delete" onsubmit="return confirm('Delete this enrollment?');"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e((string) $item['id']) ?>"><button type="submit" class="danger">Delete</button></form></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
