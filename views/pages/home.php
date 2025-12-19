<div class="card">
  <h2 style="margin-top:0">Running ✅</h2>
  <p>This is a working Z-Stack v1.2 skeleton with real flow (routes → controller → view).</p>

  <ul>
    <li><a href="<?= e(url('/login')) ?>">/login</a></li>
    <li><a href="<?= e(url('/api/ping')) ?>">/api/ping</a></li>
    <li><a href="<?= e(url('/sitemap.xml')) ?>">/sitemap.xml</a></li>
    <li><a href="<?= e(url('/robots.txt')) ?>">/robots.txt</a></li>
  </ul>

  <p><strong>Auth:</strong> <?= $userId ? "Logged in as user_id = " . (int)$userId : "Not logged in" ?></p>

  <p class="badge" style="margin-top:12px">
    Home runs without DB. Login demo requires DB configuration and a <code>users</code> table.
  </p>
</div>
