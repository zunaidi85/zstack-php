<div class="card">
  <h2 style="margin-top:0">Login</h2>
  <form method="post" action="<?= e(url('/login')) ?>">
    <?= csrf_field() ?>
    <div style="display:grid;gap:10px;max-width:420px">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password (min 6)" required>
      <button type="submit">Sign in</button>
    </div>
  </form>

  <p class="badge" style="margin-top:12px">
    Demo login requires DB + users table. If DB is not set, you will see a helpful message.
  </p>
</div>
