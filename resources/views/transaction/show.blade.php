<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            Detail Transaksi - {{ $transaction->invoice_code }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Kiri: Info Transaksi -->
                    <div>
                        <h3 class="text-lg font-bold border-b pb-2 mb-4">Informasi Tiket</h3>
                        
                        <div class="space-y-3 mb-6">
                            <p><span class="text-gray-500">Tanggal Kunjungan:</span> <br> <span class="font-semibold">{{ $transaction->visit_date }}</span></p>
                            
                            <p><span class="text-gray-500">Tiket Dewasa:</span> <br> <span class="font-semibold">{{ $transaction->adult_quantity }} tiket (IDR {{ number_format($transaction->adult_price, 0, ',', '.') }})</span></p>
                            
                            <p><span class="text-gray-500">Tiket Anak:</span> <br> <span class="font-semibold">{{ $transaction->child_quantity }} tiket (IDR {{ number_format($transaction->child_price, 0, ',', '.') }})</span></p>

                            <div class="pt-4 mt-4 border-t">
                                <p><span class="text-gray-500">Total Pembayaran:</span> <br> <span class="text-2xl font-bold text-green-700">IDR {{ number_format($transaction->total_price, 0, ',', '.') }}</span></p>
                            </div>
                        </div>

                        <div class="bg-blue-50 p-4 rounded text-sm text-blue-800 mb-6">
                            Silahkan transfer sejumlah <b>IDR {{ number_format($transaction->total_price, 0, ',', '.') }}</b> ke rekening:
                            <br><b>BCA 1234567890 a.n Kebun Raya Bogor</b>
                        </div>
                    </div>

                    <!-- Kanan: Upload Bukti -->
                    <div>
                        <h3 class="text-lg font-bold border-b pb-2 mb-4">Bukti Pembayaran</h3>
                        
                        @if($transaction->payment_proof)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Anda sudah mengunggah bukti pembayaran.</p>
                                <img src="{{ asset('storage/' . $transaction->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-full h-auto rounded border">
                                
                                @if($transaction->status === 'pending')
                                    <div class="mt-4 bg-yellow-100 text-yellow-800 p-3 rounded">
                                        Status: <b>Menunggu Konfirmasi Admin</b>
                                    </div>
                                @elseif($transaction->status === 'lunas')
                                    <div class="mt-4 bg-green-100 text-green-800 p-3 rounded">
                                        Status: <b>Lunas / Terverifikasi</b>
                                    </div>
                                    <a href="{{ route('transaction.ticket', $transaction) }}" class="mt-4 block text-center w-full bg-green-700 text-white font-bold py-2 px-4 rounded hover:bg-green-800">
                                        Download E-Ticket
                                    </a>
                                @endif
                            </div>
                        @else
                            <form action="{{ route('transaction.proof', $transaction) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="payment_proof">
                                        Upload Bukti Transfer (JPG/PNG)
                                    </label>
                                    <input type="file" name="payment_proof" id="payment_proof" required accept="image/*"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @error('payment_proof')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                                    Unggah Bukti & Konfirmasi
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
