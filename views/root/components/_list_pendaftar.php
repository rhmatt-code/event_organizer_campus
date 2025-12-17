<?php if ($participants->num_rows == 0): ?>
  <p class="text-gray-500 text-center">Belum ada pendaftar</p>
<?php else: ?>
<table class="w-full border text-sm">
  <thead class="bg-gray-100">
    <tr>
      <th class="border p-2">No</th>
      <th class="border p-2">Nama</th>
      <th class="border p-2">Email</th>
      <th class="border p-2">Waktu Daftar</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; while ($p = $participants->fetch_assoc()): ?>
    <tr>
      <td class="border p-2 text-center"><?= $no++; ?></td>
      <td class="border p-2"><?= htmlspecialchars($p['name']); ?></td>
      <td class="border p-2"><?= htmlspecialchars($p['email']); ?></td>
      <td class="border p-2"><?= $p['created_at']; ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php endif; ?>
