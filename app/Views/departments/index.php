<section>
    <div class="page-head"><div><h2>Departments</h2><p class="muted">Manage academic departments.</p></div></div>
    <div class="card form-card">
        <h3>Add department</h3>
        <form method="POST" action="/departments/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Name</span><input name="name" value="<?= e(old('name')) ?>" required></label>
            <label><span>Code</span><input name="code" value="<?= e(old('code')) ?>" required></label>
            <button type="submit">Save</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Name</th><th>Code</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['name']) ?></td>
                    <td><?= e($item['code']) ?></td>
                    <td>
                        <form method="POST" action="/departments/delete" onsubmit="return confirm('Delete this department?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= e((string) $item['id']) ?>">
                            <button type="submit" class="danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
