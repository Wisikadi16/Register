<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            ✏️ Edit Tagihan Utilitas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-amber-500">
                <form action="{{ route('admin.dinkes.utilities.update', $utility->id) }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Jenis Utilitas</label>
                        <select name="type" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="listrik" {{ $utility->type == 'listrik' ? 'selected' : '' }}>Listrik</option>
                            <option value="pam" {{ $utility->type == 'pam' ? 'selected' : '' }}>PAM (Air)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Nominal Tagihan</label>
                        <input type="number" name="amount" value="{{ old('amount', $utility->amount) }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Periode (Bulan-Tahun)</label>
                        <input type="month" name="billing_period"
                            value="{{ old('billing_period', $utility->billing_period) }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Status Pembayaran</label>
                        <select name="status" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="unpaid" {{ $utility->status == 'unpaid' ? 'selected' : '' }}>Belum Lunas
                                (Unpaid)</option>
                            <option value="paid" {{ $utility->status == 'paid' ? 'selected' : '' }}>Lunas (Paid)</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('admin.dinkes.utilities.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded shadow transition text-sm">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded shadow-lg transition text-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>