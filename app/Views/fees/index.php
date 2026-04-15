<section>
    <div class="page-head"><div><h2>Fees</h2><p class="muted">Track fee dues and payments.</p></div></div>
    <div class="card form-card">
        <h3>Create fee record</h3>
        <form method="POST" action="/fees/store" class="grid-form auto-grid">
            <?= csrf_field() ?>
            <label><span>Student</span><select name="student_id"><?php foreach ($students as $student): ?><option value="<?= e((string) $student['id']) ?>"><?= e($student['name']) ?> (<?= e($student['roll_no']) ?>)</option><?php endforeach; ?></select></label>
            <label><span>Amount</span><input type="number" name="amount" step="0.01" required></label>
            <label><span>Due Date</span><input type="date" name="due_date" required></label>
            <label><span>Status</span><select name="status"><option value="pending">Pending</option><option value="paid">Paid</option></select></label>
            <label><span>Remarks</span><input name="remarks"></label>
            <button type="submit">Save</button>
        </form>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>Student</th><th>Roll No</th><th>Amount</th><th>Due</th><th>Status</th><th>Paid At</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['student_name']) ?></td><td><?= e($item['roll_no']) ?></td><td>INR <?= e(number_format((float) $item['amount'], 2)) ?></td><td><?= e($item['due_date']) ?></td><td><?= e($item['status']) ?></td><td><?= e($item['paid_at'] ?: '-') ?></td>
                    <td>
                        <?php if ($item['status'] !== 'paid'): ?>
                            <form method="POST" action="/fees/pay"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e((string) $item['id']) ?>"><button type="submit">Mark Paid</button></form>
                        <?php else: ?>
                            <span class="muted">Settled</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
