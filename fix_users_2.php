<?php
$file = 'resources/views/admin/users.blade.php';
$content = file_get_contents($file);

// 1. Add "Tambah Admin" button to Admin section header
$adminHeaderOld = <<<'EOF'
                    <!-- HEADER -->
                    <div class="px-6 py-5 bg-slate-50 flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-[#1e3a5f]
                                        text-white flex items-center justify-center text-xl">

                                <i class="fa-solid fa-user-shield"></i>

                            </div>

                            <div>

                                <h3 class="text-xl font-bold text-[#1e3a5f]">
                                    Administrator
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Pengelola sistem aplikasi GRAHA
                                </p>

                            </div>

                        </div>

                        <button onclick="toggleSection('adminSection')"
                                class="px-5 py-3 rounded-xl bg-[#1e3a5f]
                                       hover:bg-[#16324a] text-white
                                       text-sm font-bold transition">

                            <i class="fa-solid fa-users mr-2"></i>
                            Lihat User

                        </button>

                    </div>
EOF;

$adminHeaderNew = <<<'EOF'
                    <!-- HEADER -->
                    <div class="px-6 py-5 bg-slate-50 flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-[#1e3a5f]
                                        text-white flex items-center justify-center text-xl">

                                <i class="fa-solid fa-user-shield"></i>

                            </div>

                            <div>

                                <h3 class="text-xl font-bold text-[#1e3a5f]">
                                    Administrator
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Pengelola sistem aplikasi GRAHA
                                </p>

                            </div>

                        </div>

                        <div class="flex items-center gap-3">
                            @if(auth()->user()->is_super_admin)
                            <button onclick="openCreateAdminModal()"
                                    class="px-5 py-3 rounded-xl bg-white border border-[#1e3a5f]
                                           text-[#1e3a5f] hover:bg-gray-50
                                           text-sm font-bold transition">
                                <i class="fa-solid fa-plus mr-2"></i> Tambah Admin
                            </button>
                            @endif
                            <button onclick="toggleSection('adminSection')"
                                    class="px-5 py-3 rounded-xl bg-[#1e3a5f]
                                           hover:bg-[#16324a] text-white
                                           text-sm font-bold transition">

                                <i class="fa-solid fa-users mr-2"></i>
                                Lihat User

                            </button>
                        </div>

                    </div>
EOF;
$content = str_replace($adminHeaderOld, $adminHeaderNew, $content);


// 2. Add Create Admin Modal & User Detail Modal HTML
$modalsHtml = <<<'EOF'

<!-- MODAL TAMBAH ADMIN -->
<div id="createAdminModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateAdminModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-[#1e3a5f]">Tambah Admin Baru</h3>
            <button onclick="closeCreateAdminModal()" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-times"></i></button>
        </div>
        <form method="POST" action="{{ route('admin.users.admin.store') }}">
            @csrf
            <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                <div>
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-1">Alamat Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-1">Kata Sandi</label>
                    <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]">
                </div>
                
                <div class="pt-2">
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Hak Akses Menu</label>
                    <div class="grid grid-cols-2 gap-3">
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
                        <label class="flex items-center gap-3 p-2 border border-gray-100 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="permissions[]" value="{{ $key }}" class="w-4 h-4 text-[#1e3a5f] border-gray-300 rounded focus:ring-[#1e3a5f]">
                            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-slate-50">
                <button type="button" onclick="closeCreateAdminModal()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-semibold hover:bg-white">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#1e3a5f] text-white font-semibold hover:bg-[#16324a]">Simpan Admin</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL DETAIL PENGGUNA -->
<div id="userDetailModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeUserDetailModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-[#1e3a5f]">Detail Pengguna</h3>
            <button onclick="closeUserDetailModal()" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="p-6 flex flex-col items-center text-center">
            <div id="udAvatar" class="w-20 h-20 rounded-full text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-md">
                --
            </div>
            <h4 id="udName" class="text-xl font-bold text-slate-800">Nama</h4>
            <p id="udEmail" class="text-sm text-gray-500 mb-4">email@mail.com</p>
            
            <div class="w-full bg-slate-50 p-4 rounded-xl text-left space-y-3">
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase">Peran</span>
                    <span id="udRole" class="text-sm font-semibold text-[#1e3a5f]">Role</span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase">Bergabung</span>
                    <span id="udJoined" class="text-sm font-semibold text-[#1e3a5f]">Tanggal</span>
                </div>
                <div class="flex flex-col pt-1">
                    <span class="text-xs font-bold text-gray-400 uppercase mb-1">Informasi Tambahan</span>
                    <span id="udExtra" class="text-sm font-semibold text-gray-700">-</span>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-100 bg-slate-50">
            <button onclick="closeUserDetailModal()" class="w-full px-5 py-2.5 rounded-xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">Tutup</button>
        </div>
    </div>
</div>

<script>
function openCreateAdminModal() {
    document.getElementById('createAdminModal').classList.remove('hidden');
}
function closeCreateAdminModal() {
    document.getElementById('createAdminModal').classList.add('hidden');
}

function openUserDetailModal(name, email, role, joined, extraInfo, roleColor) {
    document.getElementById('udName').textContent = name;
    document.getElementById('udEmail').textContent = email;
    document.getElementById('udRole').textContent = role;
    document.getElementById('udJoined').textContent = joined;
    document.getElementById('udExtra').textContent = extraInfo;
    
    const avatar = document.getElementById('udAvatar');
    avatar.textContent = name.substring(0, 2).toUpperCase();
    avatar.style.backgroundColor = roleColor;
    
    document.getElementById('userDetailModal').classList.remove('hidden');
}
function closeUserDetailModal() {
    document.getElementById('userDetailModal').classList.add('hidden');
}
</script>
EOF;

// Insert new modals at the end (before the last script tag if possible, or append)
$content = str_replace('<script>', $modalsHtml . "\n<script>", $content);

// 3. Update "Lihat Detail" buttons to trigger modal
// For Admin
$adminLihatDetailOld = <<<'EOF'
                                    <button class="w-full border border-[#1e3a5f] text-[#1e3a5f] hover:bg-[#1e3a5f] hover:text-white transition py-2.5 rounded-xl text-sm font-semibold">
                                        Lihat Detail
                                    </button>
EOF;
$adminLihatDetailNew = <<<'EOF'
                                    <button onclick="openUserDetailModal('{{ addslashes($admin->name) }}', '{{ $admin->email }}', 'Administrator', '{{ $admin->created_at ? $admin->created_at->format('d M Y') : '-' }}', '{{ $admin->is_super_admin ? 'Super Admin (Akses Penuh)' : 'Hak Akses Khusus' }}', '#1e3a5f')" 
                                            class="w-full border border-[#1e3a5f] text-[#1e3a5f] hover:bg-[#1e3a5f] hover:text-white transition py-2.5 rounded-xl text-sm font-semibold">
                                        Lihat Detail
                                    </button>
EOF;
$content = str_replace($adminLihatDetailOld, $adminLihatDetailNew, $content);

// For Pengguna (assuming they are static, I will just update the static one as an example, since they are hardcoded currently)
// If we had a loop we would do the same. I'll just regex replace the "Detail" button for Pengguna and "Lihat Detail" for Owner.

$penggunaDetailPattern = '/<button class="bg-\[\#38a38e\].*?>\s*Detail\s*<\/button>/is';
$penggunaDetailReplacement = <<<'EOF'
<button onclick="openUserDetailModal('Siti Aminah', 'siti@mail.com', 'Penghuni', '01 Jan 2026', 'Tinggal di Kost Graha Asri', '#38a38e')" 
        class="bg-[#38a38e] hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
    Detail
</button>
EOF;
$content = preg_replace($penggunaDetailPattern, $penggunaDetailReplacement, $content);


$ownerDetailPattern = '/<button class="mt-5 w-full bg-orange-500.*?Lihat Detail\s*<\/button>/is';
$ownerDetailReplacement = <<<'EOF'
<button onclick="openUserDetailModal('Budi Santoso', 'budi@mail.com', 'Owner', '15 Feb 2025', 'Memiliki 2 Properti', '#f97316')" 
        class="mt-5 w-full bg-orange-500 hover:bg-orange-600 text-white py-2.5 rounded-xl text-sm font-semibold transition">
    Lihat Detail
</button>
EOF;
$content = preg_replace($ownerDetailPattern, $ownerDetailReplacement, $content);

file_put_contents($file, $content);
echo "Done";
