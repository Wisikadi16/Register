<x-app-layout>
    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() == url()->current() ? route('operator.dashboard') : url()->previous() }}"
                class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-charcoal transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-black text-charcoal">Pusat Bantuan & Komplain Faskes</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-800 text-white sticky top-0 z-10 shadow-md">
                    <tr>
                        <th class="p-4 text-sm font-bold">Faskes Pelapor</th>
                        <th class="p-4 text-sm font-bold">Kategori & Keluhan</th>
                        <th class="p-4 text-sm font-bold">Status</th>
                        <th class="p-4 text-sm font-bold">Aksi (Proses Tiket)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="p-4 align-top">
                                <p class="font-bold text-charcoal">{{ $req->user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $req->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="p-4 max-w-md align-top">
                                <span class="text-xs font-bold text-blue-600">{{ $req->category }}</span>
                                <p class="text-sm font-medium text-charcoal mb-1">{{ $req->description }}</p>
                                @if($req->photo_proof)
                                    <a href="{{ asset('storage/' . $req->photo_proof) }}" target="_blank"
                                        class="text-xs text-blue-500 hover:text-blue-700 underline flex items-center gap-1 mt-2">
                                        <i class="fas fa-image"></i> Lihat Foto Bukti
                                    </a>
                                @endif
                            </td>
                            <td class="p-4 align-top">
                                <span class="px-3 py-1 text-xs font-bold rounded-full uppercase inline-block
                                                        {{ $req->status == 'pending' ? 'bg-red-100 text-red-700 animate-pulse border border-red-300' : '' }}
                                                        {{ $req->status == 'process' ? 'bg-blue-100 text-blue-700' : '' }}
                                                        {{ $req->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                                        {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    @if($req->status == 'pending')
                                        <i class="fas fa-circle text-[8px] mr-1"></i>
                                    @endif
                                    {{ $req->status }}
                                </span>
                            </td>
                            <td class="p-4 bg-slate-50 border-l border-slate-100 w-72 align-top">
                                <form action="{{ route('operator.requests.update', $req->id) }}" method="POST"
                                    class="flex flex-col gap-2">
                                    @csrf
                                    <select name="status"
                                        class="w-full rounded-lg border-slate-300 text-sm py-1.5 focus:ring-blue-500 focus:border-blue-500"
                                        {{ $req->status == 'completed' ? 'disabled' : '' }}>
                                        <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="process" {{ $req->status == 'process' ? 'selected' : '' }}>Proses /
                                            Kirim Teknisi</option>
                                        <option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Tolak
                                        </option>
                                    </select>
                                    <textarea name="operator_notes" rows="2"
                                        class="w-full rounded-lg border-slate-300 text-sm py-1 px-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Tulis balasan untuk faskes..." {{ $req->status == 'completed' ? 'disabled' : '' }}>{{ $req->operator_notes }}</textarea>
                                    @if($req->status != 'completed')
                                        <button type="submit"
                                            class="bg-charcoal hover:bg-slate-800 text-white text-xs font-bold py-2 rounded-lg transition-colors shadow-sm">Update
                                            Tiket</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center text-slate-400 bg-slate-50/50">
                                <div
                                    class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-slate-100">
                                    <i class="fas fa-clipboard-check text-4xl text-slate-300"></i>
                                </div>
                                <h3 class="font-bold text-lg text-slate-600 mb-1">Semua Tiket Tuntas!</h3>
                                <p class="text-sm">Belum ada komplain atau pengajuan masuk dari Faskes saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>