<?php
$file = 'resources/views/admin/users.blade.php';
$content = file_get_contents($file);

// Replace the hardcoded admin card with a foreach loop
$oldAdminSection = <<<'EOF'
                    <!-- CONTENT -->
                    <div id="adminSection" class="hidden p-6 bg-white border-t border-gray-100">

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

                            <!-- CARD -->
                            <div class="border border-gray-100 rounded-2xl p-5 hover:bg-slate-50 transition">

                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-4">

                                        <div class="w-14 h-14 rounded-full bg-[#1e3a5f]
                                                    text-white flex items-center justify-center font-bold">

                                            GP

                                        </div>

                                        <div>

                                            <h4 class="font-bold text-[#1e3a5f] text-lg">
                                                Guntur Putra
                                            </h4>

                                            <p class="text-sm text-gray-500">
                                                guntur@mail.com
                                            </p>

                                        </div>

                                    </div>

                                    <span class="px-3 py-1 rounded-full
                                                 bg-blue-50 text-blue-600
                                                 text-xs font-bold">

                                        Admin

                                    </span>

                                </div>

                                <button class="mt-5 w-full border border-[#1e3a5f]
                                               text-[#1e3a5f] hover:bg-[#1e3a5f]
                                               hover:text-white transition
                                               py-2.5 rounded-xl text-sm font-semibold">

                                    Lihat Detail

                                </button>

                            </div>

                        </div>

                    </div>
EOF;

$newAdminSection = <<<'EOF'
                    <!-- CONTENT -->
                    <div id="adminSection" class="hidden p-6 bg-white border-t border-gray-100">

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                            @foreach($users->where('role', 'admin') as $admin)
                            <!-- CARD -->
                            <div class="border border-gray-100 rounded-2xl p-5 hover:bg-slate-50 transition relative">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($admin->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-[#1e3a5f] text-lg flex items-center">
                                                {{ $admin->name }}
                                                @if($admin->is_super_admin)
                                                <span class="ml-2 px-2 py-0.5 rounded text-[10px] bg-red-100 text-red-600 font-bold border border-red-200">SUPER</span>
                                                @endif
                                            </h4>
                                            <p class="text-sm text-gray-500">{{ $admin->email }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">Admin</span>
                                </div>
                                <div class="mt-5 grid grid-cols-2 gap-2">
                                    <button class="w-full border border-[#1e3a5f] text-[#1e3a5f] hover:bg-[#1e3a5f] hover:text-white transition py-2.5 rounded-xl text-sm font-semibold">
                                        Lihat Detail
                                    </button>
                                    @if(auth()->user()->is_super_admin && !$admin->is_super_admin)
                                    <button onclick="openPermissionModal({{ $admin->id }}, '{{ addslashes($admin->name) }}', {{ json_encode($admin->permissions ?? []) }})" class="w-full bg-[#1e3a5f] text-white hover:bg-[#16324a] transition py-2.5 rounded-xl text-sm font-semibold flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-key"></i> Hak Akses
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
EOF;

$content = str_replace($oldAdminSection, $newAdminSection, $content);

// Add the modal and script at the end of the file
$modalHtml = <<<'EOF'

<!-- MODAL HAK AKSES -->
<div id="permissionModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closePermissionModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-[#1e3a5f]">Atur Hak Akses</h3>
            <button onclick="closePermissionModal()" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-times"></i></button>
        </div>
        <form id="permissionForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="p-6">
                <p class="text-sm text-gray-500 mb-4">Pilih menu yang dapat diakses oleh <strong id="permAdminName" class="text-[#1e3a5f]"></strong>:</p>
                
                <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                    @php
                    $availableMenus = [
                        'dashboard' => 'Dashboard',
                        'enrollment' => 'Verifikasi Akun',
                        'users' => 'Pengguna',
                        'detail' => 'Kost',
                        'tagihan' => 'Transaksi',
                        'complaints' => 'Komplain',
                        'laporan' => 'Laporan',
                        'pengaturan' => 'Pengaturan'
                    ];
                    @endphp
                    @foreach($availableMenus as $key => $label)
                    <label class="flex items-center gap-3 p-3 border border-gray-100 rounded-xl hover:bg-gray-50 cursor-pointer">
                        <input type="checkbox" name="permissions[]" value="{{ $key }}" class="perm-checkbox w-5 h-5 text-[#38a38e] border-gray-300 rounded focus:ring-[#38a38e]">
                        <span class="font-medium text-gray-700">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-slate-50">
                <button type="button" onclick="closePermissionModal()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-semibold hover:bg-white">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#1e3a5f] text-white font-semibold hover:bg-[#16324a]">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openPermissionModal(userId, userName, permissions) {
    document.getElementById('permAdminName').textContent = userName;
    document.getElementById('permissionForm').action = '/admin/users/' + userId + '/permissions';
    
    // Uncheck all first
    document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = false);
    
    // Check what is currently allowed
    if (permissions && Array.isArray(permissions)) {
        permissions.forEach(perm => {
            const cb = document.querySelector(`.perm-checkbox[value="${perm}"]`);
            if (cb) cb.checked = true;
        });
    }
    
    document.getElementById('permissionModal').classList.remove('hidden');
}

function closePermissionModal() {
    document.getElementById('permissionModal').classList.add('hidden');
}
</script>
EOF;

// Insert before the closing </body> tag or at the end if not found
$content .= $modalHtml;

file_put_contents($file, $content);
echo "Successfully updated users.blade.php\n";
