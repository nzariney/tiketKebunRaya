<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiket Kebun Raya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-brand-cream text-gray-800 font-sans selection:bg-brand-orange selection:text-white">

    <nav class="bg-brand-green shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-2xl font-black text-brand-orange tracking-wider uppercase">Kebun Raya</span>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-white hover:text-brand-orange font-semibold transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-brand-orange font-semibold transition">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-brand-orange text-brand-green px-5 py-2.5 rounded-full hover:bg-yellow-500 hover:shadow-lg transition font-black uppercase text-sm tracking-wider">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Info Section / Hero -->
    <div class="bg-brand-green text-brand-cream py-20 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6 text-brand-orange uppercase tracking-tight">Menyatu dengan Alam</h1>
            <p class="text-lg md:text-xl leading-relaxed mb-10 opacity-90">
                Rasakan kedamaian dan keindahan alam di Kebun Raya. Jelajahi ribuan koleksi tanaman, nikmati udara segar, dan ciptakan momen tak terlupakan bersama keluarga dan sahabat di paru-paru kota tercinta.
            </p>
            <a href="#booking-section" class="inline-block bg-brand-orange text-brand-green font-black uppercase tracking-wider px-8 py-4 rounded-full hover:bg-yellow-500 transition-all hover:scale-105 shadow-lg">
                Pesan Tiket Sekarang
            </a>
        </div>
    </div>

    <!-- Features -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6">
            <div class="w-16 h-16 bg-brand-green text-brand-orange rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-black">1</div>
            <h3 class="text-xl font-bold text-brand-green mb-2">Edukasi Alam</h3>
            <p class="text-gray-600">Pelajari ribuan spesies tanaman langka dan dilindungi dari seluruh dunia.</p>
        </div>
        <div class="p-6">
            <div class="w-16 h-16 bg-brand-green text-brand-orange rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-black">2</div>
            <h3 class="text-xl font-bold text-brand-green mb-2">Rekreasi Keluarga</h3>
            <p class="text-gray-600">Area piknik luas dan taman bermain anak yang aman serta nyaman.</p>
        </div>
        <div class="p-6">
            <div class="w-16 h-16 bg-brand-green text-brand-orange rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-black">3</div>
            <h3 class="text-xl font-bold text-brand-green mb-2">Spot Fotografi</h3>
            <p class="text-gray-600">Beragam lokasi estetik yang sempurna untuk mengabadikan momen berharga.</p>
        </div>
    </div>

    <div id="booking-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <div class="text-center mb-12">
            <h2 class="text-4xl font-black text-brand-green mb-4 uppercase">Tiket Masuk</h2>
            <div class="w-24 h-1 bg-brand-orange mx-auto rounded"></div>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm mb-8">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kiri: Pilih Tiket -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-2xl shadow-xl border-t-4 border-brand-green">
                        <h2 class="text-2xl font-black text-brand-green mb-6 border-b pb-4">Tanggal Kunjungan</h2>
                        <input type="date" name="visit_date" @guest disabled @endguest required class="w-full md:w-1/2 p-4 text-lg border-2 border-gray-200 rounded-xl focus:ring-brand-green focus:border-brand-green transition-colors @guest bg-gray-100 cursor-not-allowed @endguest" min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-xl border-t-4 border-brand-orange">
                        <h2 class="text-2xl font-black text-brand-green mb-6 border-b pb-4">Pilih Kategori Tiket</h2>
                        
                        <!-- Tiket Dewasa -->
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-8 p-4 rounded-xl bg-brand-cream/30 border border-brand-green/20">
                            <div class="mb-4 sm:mb-0">
                                <h3 class="font-bold text-xl text-brand-green">Tiket Pengunjung Dewasa</h3>
                                <p class="text-gray-600 mt-1 text-sm">Tiket masuk pengunjung domestik (WNI).</p>
                                <p class="text-brand-orange font-black text-xl mt-2">IDR 25.000</p>
                            </div>
                            <div class="flex items-center space-x-4 bg-white shadow-sm border border-gray-200 rounded-full p-1">
                                <button type="button" @guest disabled @endguest class="w-10 h-10 rounded-full bg-gray-100 text-brand-green hover:bg-brand-cream font-bold transition-colors @guest cursor-not-allowed @endguest" onclick="updateQty('adult', -1)">-</button>
                                <input type="number" name="adult_quantity" id="adult_qty" value="0" min="0" class="w-12 text-center border-none font-bold text-lg focus:ring-0 p-0 text-brand-green" readonly>
                                <button type="button" @guest disabled @endguest class="w-10 h-10 rounded-full bg-brand-green text-brand-orange hover:bg-opacity-90 font-bold shadow-md transition-colors @guest opacity-50 cursor-not-allowed @endguest" onclick="updateQty('adult', 1)">+</button>
                            </div>
                        </div>

                        <!-- Tiket Anak -->
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center p-4 rounded-xl bg-brand-cream/30 border border-brand-green/20">
                            <div class="mb-4 sm:mb-0">
                                <h3 class="font-bold text-xl text-brand-green">Tiket Pengunjung Anak</h3>
                                <p class="text-gray-600 mt-1 text-sm">Tiket masuk untuk anak-anak dibawah 12 tahun.</p>
                                <p class="text-brand-orange font-black text-xl mt-2">IDR 15.000</p>
                            </div>
                            <div class="flex items-center space-x-4 bg-white shadow-sm border border-gray-200 rounded-full p-1">
                                <button type="button" @guest disabled @endguest class="w-10 h-10 rounded-full bg-gray-100 text-brand-green hover:bg-brand-cream font-bold transition-colors @guest cursor-not-allowed @endguest" onclick="updateQty('child', -1)">-</button>
                                <input type="number" name="child_quantity" id="child_qty" value="0" min="0" class="w-12 text-center border-none font-bold text-lg focus:ring-0 p-0 text-brand-green" readonly>
                                <button type="button" @guest disabled @endguest class="w-10 h-10 rounded-full bg-brand-green text-brand-orange hover:bg-opacity-90 font-bold shadow-md transition-colors @guest opacity-50 cursor-not-allowed @endguest" onclick="updateQty('child', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Ringkasan -->
                <div class="md:col-span-1">
                    <div class="bg-brand-green p-8 rounded-2xl shadow-xl sticky top-6 text-brand-cream">
                        <h2 class="text-2xl font-black text-brand-orange mb-6 border-b border-brand-cream/20 pb-4">Detail Pemesanan</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between">
                                <span class="opacity-90">Tiket Dewasa (<span id="summary_adult_qty" class="font-bold text-white">0</span>x)</span>
                                <span class="font-semibold text-white">IDR <span id="summary_adult_price">0</span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="opacity-90">Tiket Anak (<span id="summary_child_qty" class="font-bold text-white">0</span>x)</span>
                                <span class="font-semibold text-white">IDR <span id="summary_child_price">0</span></span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between font-black text-xl border-t border-brand-cream/20 pt-6 mb-8">
                            <span>Total Harga</span>
                            <span class="text-brand-orange">IDR <span id="summary_total">0</span></span>
                        </div>

                        @auth
                            <button type="submit" class="w-full bg-brand-orange text-brand-green py-4 rounded-xl font-black text-lg hover:bg-yellow-500 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 uppercase tracking-wide">
                                Lanjutkan Pembayaran
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block text-center w-full bg-white/20 text-white py-4 rounded-xl font-bold text-lg hover:bg-white/30 transition-all duration-200">
                                Login untuk Memesan
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const priceAdult = 25000;
        const priceChild = 15000;

        function updateQty(type, change) {
            const input = document.getElementById(type + '_qty');
            let val = parseInt(input.value) + change;
            if (val < 0) val = 0;
            input.value = val;
            updateSummary();
        }

        function updateSummary() {
            const adultQty = parseInt(document.getElementById('adult_qty').value);
            const childQty = parseInt(document.getElementById('child_qty').value);
            
            document.getElementById('summary_adult_qty').innerText = adultQty;
            document.getElementById('summary_child_qty').innerText = childQty;
            
            document.getElementById('summary_adult_price').innerText = (adultQty * priceAdult).toLocaleString('id-ID');
            document.getElementById('summary_child_price').innerText = (childQty * priceChild).toLocaleString('id-ID');
            
            const total = (adultQty * priceAdult) + (childQty * priceChild);
            document.getElementById('summary_total').innerText = total.toLocaleString('id-ID');
        }
    </script>
</body>
</html>
