<x-app-layout>
    <div class="container">
        <h1 class="text-2xl font-semibold mb-4">Tambah Transaksi Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf
            <div class="mb-4">
                <label for="customer_id" class="form-label">Pelanggan</label>
                <select name="customer_id" id="customer_id" 
                        class="form-control" required>
                    <option value="">Pilih Pelanggan</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} ({{ $customer->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="product_id" class="form-label">Produk</label>
                <select name="product_id" id="product_id" 
                        class="form-control" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="total_price" class="form-label">Total Harga</label>
                <input type="number" name="total_price" id="total_price" value="{{ old('total_price') }}" 
                        class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" id="transaction_date" 
                        value="{{ old('transaction_date', now()->format('Y-m-d')) }}" 
                        class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
    document.getElementById('product_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        if (price) {
            document.getElementById('total_price').value = price;
        }
    });
</script>
</x-app-layout>