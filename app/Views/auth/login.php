<section class="auth-card">
    <div>
        <h2>Welcome to EduNexus</h2>
        <p class="muted">A streamlined college ERP for academics, attendance, exams, and administration.</p>
    </div>
    <form method="POST" action="/login" class="grid-form">
        <?= csrf_field() ?>
        <label><span>Email</span><input type="email" name="email" value="<?= e(old('email')) ?>" required></label>
        <label><span>Password</span><input type="password" name="password" required></label>
        <button type="submit">Login</button>
    </form>
    <div class="card soft">
        <strong>Demo credentials</strong>
        <p class="muted">admin@edunexus.local / password</p>
        <p class="muted">faculty@edunexus.local / password</p>
        <p class="muted">accounts@edunexus.local / password</p>
    </div>
</section>
