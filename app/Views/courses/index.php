<section>
    <div class="page-head"><div><h2>Courses</h2><p class="muted">Manage curriculum and faculty assignments.</p></div></div>
    <div class="card form-card">
        <h3>Add course</h3>
        <form method="POST" action="/courses/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Code</span><input name="code" required></label>
            <label><span>Title</span><input name="title" required></label>
            <label><span>Department</span><select name="department_id"><?php foreach ($departments as $department): ?><option value="<?= e((string) $department['id']) ?>"><?= e($department['name']) ?></option><?php endforeach; ?></select></label>
            <label><span>Semester</span><input type="number" name="semester" value="1" min="1" max="8"></label>
            <label><span>Credits</span><input type="number" name="credits" value="4" min="1" max="10"></label>
            <label><span>Faculty</span><select name="faculty_id"><?php foreach ($faculties as $faculty): ?><option value="<?= e((string) $faculty['id']) ?>"><?= e($faculty['name']) ?></option><?php endforeach; ?></select></label>
            <button type="submit">Save</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Code</th><th>Title</th><th>Department</th><th>Semester</th><th>Credits</th><th>Faculty</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['code']) ?></td><td><?= e($item['title']) ?></td><td><?= e($item['department_name'] ?? '-') ?></td><td><?= e((string) $item['semester']) ?></td><td><?= e((string) $item['credits']) ?></td><td><?= e($item['faculty_name'] ?? '-') ?></td>
                    <td><form method="POST" action="/courses/delete" onsubmit="return confirm('Delete this course?');"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e((string) $item['id']) ?>"><button type="submit" class="danger">Delete</button></form></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
