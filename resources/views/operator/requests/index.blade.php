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
                <thead>
                    <tr class="bg-slate-800 text-white">
                        <th class="p-4 text-sm font-bold">Faskes Pelapor</th>
                        <th class="p-4 text-sm font-bold">Kategori & Keluhan</th>
                        <th class="p-4 text-sm font-bold">Status</th>
                        <th class="p-4 text-sm font-bold">Aksi (Proses Tiket)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $req)
                        <tr class="border-b border-slate-100">
                            <td class="p-4">
                                <p class="font-bold text-charcoal">{{ $req->user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $req->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="p-4 max-w-md">
                                <span class="text-xs font-bold text-blue-600">{{ $req->category }}</span>
                                <p class="text-sm font-medium text-charcoal mb-1">{{ $req->description }}</p>
                                @if($req->photo_proof)
                                    <a href="{{ asset('storage/' . $req->photo_proof) }}" target="_blank"
                                        class="text-xs text-blue-500 underline"><i class="fas fa-image"></i> Lihat Foto
                                        Bukti</a>
                                @endif
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full uppercase
                                                    {{ $req->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                                    {{ $req->status == 'process' ? 'bg-blue-100 text-blue-700' : '' }}
                                                    {{ $req->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                                    {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $req->status }}
                                </span>
                            </td>
                            <td class="p-4 bg-slate-50 border-l border-slate-100">
                                <form action="{{ route('operator.requests.update', $req->id) }}" method="POST"
                                    class="flex flex-col gap-2">
                                    @csrf
                                    <select name="status" class="w-full rounded-lg border-slate-300 text-sm py-1.5" {{ $req->status == 'completed' ? 'disabled' : '' }}>
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
                                        class="w-full rounded-lg border-slate-300 text-sm py-1 px-2"
                                        placeholder="Tulis balasan untuk faskes..." {{ $req->status == 'completed' ? 'disabled' : '' }}>{{ $req->operator_notes }}</textarea>
                                    @if($req->status != 'completed')
                                        <button type="submit"
                                            class="bg-charcoal hover:bg-slate-800 text-white text-xs font-bold py-2 rounded-lg transition">Update
                                            Tiket</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>