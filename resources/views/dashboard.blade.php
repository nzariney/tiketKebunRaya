<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-brand-green">Tiket Saya</h3>
                    
                    @if($transactions->isEmpty())
                        <p class="text-gray-500">Anda belum memiliki transaksi tiket.</p>
                        <a href="{{ route('home') }}" class="text-green-600 hover:underline mt-2 inline-block">Beli tiket sekarang</a>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kunjungan</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($transactions as $trx)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $trx->invoice_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $trx->visit_date }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IDR {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($trx->status === 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                                @elseif($trx->status === 'lunas')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas / Terverifikasi</span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">{{ ucfirst($trx->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('transaction.show', $trx) }}" class="text-blue-600 hover:text-blue-900">Lihat / Bayar</a>
                                                
                                                @if($trx->status === 'lunas')
                                                    <a href="{{ route('transaction.ticket', $trx) }}" class="text-green-600 hover:text-green-900 font-bold ml-3">⬇ Download Tiket</a>
                                                @else
                                                    <button disabled class="text-gray-400 cursor-not-allowed font-bold ml-3" title="Menunggu Konfirmasi">⬇ Download Tiket</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
