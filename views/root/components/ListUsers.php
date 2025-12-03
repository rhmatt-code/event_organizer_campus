<div class="p-6">
    <div class="">
        <table class="table-fixed border border-gray-200 rounded-lg ">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                </tr>
            </thead>
            <tbody class="diivide-y divide-gray-200">
                <?php foreach ($list as $data): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-600"><?= $data['name'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['role'] ?></td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>
    </div>
</div>