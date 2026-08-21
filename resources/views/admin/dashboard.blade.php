<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'role-updated')
                <div class="rounded-lg border border-[var(--leaf)] bg-[var(--leaf-soft)] px-4 py-3 text-sm text-[var(--leaf)] font-medium">
                    Role pengguna berhasil diperbarui.
                </div>
            @elseif (session('status') === 'user-deleted')
                <div class="rounded-lg border border-[var(--leaf)] bg-[var(--leaf-soft)] px-4 py-3 text-sm text-[var(--leaf)] font-medium">
                    Pengguna berhasil dihapus.
                </div>
            @elseif (session('error'))
                <div class="rounded-lg border border-red-800 bg-red-950/40 px-4 py-3 text-sm text-red-400 font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Site-wide stats -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Total pengguna</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($totalUsers, 0, ',', '.') }}</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Total aksi</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($totalActions, 0, ',', '.') }}</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Makanan terselamatkan</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($totalKg, 1, ',', '.') }} kg</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">CO2 dicegah</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--leaf)]">{{ number_format($totalCo2, 1, ',', '.') }} kg</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Nilai ekonomi</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--mango-deep)]">Rp{{ number_format($totalRp, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- User management -->
            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
                    <h3 class="font-semibold text-[var(--ink)]">Kelola pengguna</h3>
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex gap-2">
                        <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama atau email..."
                            class="bg-[var(--paper-card)] text-[var(--ink)] border-[var(--line)] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                        <x-secondary-button type="submit">Cari</x-secondary-button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)] border-b border-[var(--line)]">
                                <th class="py-2 pr-4">Nama</th>
                                <th class="py-2 pr-4">Role</th>
                                <th class="py-2 pr-4">Aksi tercatat</th>
                                <th class="py-2 pr-4">Kg terselamatkan</th>
                                <th class="py-2 pr-4">Bergabung</th>
                                <th class="py-2 pr-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-[var(--line)] last:border-0">
                                    <td class="py-3 pr-4">
                                        <div class="font-semibold text-[var(--ink)]">{{ $user->name }}</div>
                                        <div class="text-xs text-[var(--ink-soft)]">{{ $user->email }}</div>
                                    </td>
                                    <td class="py-3 pr-4">
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold
                                            {{ $user->isAdmin() ? 'bg-[var(--mango)]/20 text-[var(--mango-deep)]' : 'bg-[var(--leaf-soft)] text-[var(--leaf)]' }}">
                                            {{ $user->isAdmin() ? 'Admin' : 'User' }}
                                        </span>
                                    </td>
                                    <td class="py-3 pr-4">{{ number_format($user->rescues_count, 0, ',', '.') }}</td>
                                    <td class="py-3 pr-4">{{ number_format((float) $user->rescues_sum_kg_saved, 1, ',', '.') }} kg</td>
                                    <td class="py-3 pr-4 text-[var(--ink-soft)]">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="py-3 pr-4">
                                        <div class="flex items-center gap-2 justify-end">
                                            <a href="{{ route('admin.users.show', $user) }}" class="text-xs font-semibold text-[var(--leaf)] hover:underline">Detail</a>

                                            @unless ($user->is(auth()->user()))
                                                <form method="POST" action="{{ route('admin.users.role', $user) }}">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="text-xs font-semibold text-[var(--ink-soft)] hover:underline">
                                                        {{ $user->isAdmin() ? 'Jadikan user' : 'Jadikan admin' }}
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                    onsubmit="return confirm('Hapus {{ $user->name }}? Semua aktivitasnya akan ikut terhapus.');">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="text-xs font-semibold text-red-600 hover:underline">Hapus</button>
                                                </form>
                                            @endunless
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-[var(--ink-soft)]">Tidak ada pengguna ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
