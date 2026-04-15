<section>
    <div class="page-head"><div><h2>Exams</h2><p class="muted">Plan and schedule assessments.</p></div></div>
    <div class="card form-card">
        <h3>Create exam</h3>
        <form method="POST" action="/exams/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Course</span><select name="course_id"><?php foreach ($courses as $course): ?><option value="<?= e((string) $course['id']) ?>"><?= e($course['title']) ?> (<?= e($course['code']) ?>)</option><?php endforeach; ?></select></label>
            <label><span>Title</span><input name="title" required></label>
            <label><span>Exam Date</span><input type="date" name="exam_date" required></label>
            <label><span>Max Marks</span><input type="number" name="max_marks" value="100" required></label>
            <button type="submit">Save exam</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Exam</th><th>Course</th><th>Code</th><th>Date</th><th>Max Marks</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['title']) ?></td><td><?= e($item['course_title']) ?></td><td><?= e($item['course_code']) ?></td><td><?= e($item['exam_date']) ?></td><td><?= e((string) $item['max_marks']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
