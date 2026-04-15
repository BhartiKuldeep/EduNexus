<section>
    <div class="page-head"><div><h2>Faculty</h2><p class="muted">Manage faculty profiles.</p></div></div>
    <div class="card form-card">
        <h3>Add faculty</h3>
        <form method="POST" action="/faculties/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Name</span><input name="name" required></label>
            <label><span>Email</span><input type="email" name="email" required></label>
            <label><span>Phone</span><input name="phone"></label>
            <label><span>Department</span><select name="department_id"><?php foreach ($departments as $department): ?><option value="<?= e((string) $department['id']) ?>"><?= e($department['name']) ?></option><?php endforeach; ?></select></label>
            <button type="submit">Save</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Department</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['name']) ?></td><td><?= e($item['email']) ?></td><td><?= e($item['phone']) ?></td><td><?= e($item['department_name'] ?? '-') ?></td>
                    <td><form method="POST" action="/faculties/delete" onsubmit="return confirm('Delete this faculty member?');"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e((string) $item['id']) ?>"><button type="submit" class="danger">Delete</button></form></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
