<section>
    <div class="page-head"><div><h2>Results</h2><p class="muted">Publish and review student results.</p></div></div>
    <div class="card form-card">
        <h3>Publish result</h3>
        <form method="POST" action="/results/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Exam</span><select name="exam_id"><?php foreach ($exams as $exam): ?><option value="<?= e((string) $exam['id']) ?>"><?= e($exam['title']) ?></option><?php endforeach; ?></select></label>
            <label><span>Student</span><select name="student_id"><?php foreach ($students as $student): ?><option value="<?= e((string) $student['id']) ?>"><?= e($student['name']) ?> (<?= e($student['roll_no']) ?>)</option><?php endforeach; ?></select></label>
            <label><span>Marks</span><input type="number" name="marks" step="0.01" required></label>
            <button type="submit">Publish</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Exam</th><th>Student</th><th>Roll No</th><th>Marks</th><th>Grade</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['exam_title']) ?></td><td><?= e($item['student_name']) ?></td><td><?= e($item['roll_no']) ?></td><td><?= e((string) $item['marks']) ?></td><td><?= e($item['grade']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
