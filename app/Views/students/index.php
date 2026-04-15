<section>
    <div class="page-head"><div><h2>Students</h2><p class="muted">Manage student records and status.</p></div></div>
    <div class="card form-card">
        <h3>Add student</h3>
        <form method="POST" action="/students/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Roll No</span><input name="roll_no" required></label>
            <label><span>Name</span><input name="name" required></label>
            <label><span>Email</span><input type="email" name="email" required></label>
            <label><span>Phone</span><input name="phone"></label>
            <label><span>Department</span><select name="department_id"><?php foreach ($departments as $department): ?><option value="<?= e((string) $department['id']) ?>"><?= e($department['name']) ?></option><?php endforeach; ?></select></label>
            <label><span>Semester</span><input type="number" name="semester" value="1" min="1" max="8"></label>
            <label><span>Status</span><select name="status"><option value="active">Active</option><option value="inactive">Inactive</option></select></label>
            <button type="submit">Save</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Roll No</th><th>Name</th><th>Email</th><th>Department</th><th>Semester</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['roll_no']) ?></td><td><?= e($item['name']) ?></td><td><?= e($item['email']) ?></td><td><?= e($item['department_name'] ?? '-') ?></td><td><?= e((string) $item['semester']) ?></td><td><?= e($item['status']) ?></td>
                    <td><form method="POST" action="/students/delete" onsubmit="return confirm('Delete this student?');"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e((string) $item['id']) ?>"><button type="submit" class="danger">Delete</button></form></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
