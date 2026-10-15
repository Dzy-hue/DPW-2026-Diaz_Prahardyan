document.addEventListener("DOMContentLoaded", async function () {
    // A. From Tambah Transaksi (tambah.html)
    const formKasir = document.getElementById("form-kasir");
    const selectProduk = document.getElementById("pilih-produk");

    if (formKasir && selectProduk) {
        // Fetch 3 file JSON sekaligus menggunakan Promise.all
        try {
            const [resPokok, resMakanan, resLainnya] = await Promise.all([
                fetch("../data/kebutuhan-pokok.json"),
                fetch("../data/makanan-minuman.json"),
                fetch("../data/kebutuhan-lainnya.json")
            ]);

            const dataPokok = await resPokok.json();
            const dataMakanan = await resMakanan.json();
            const dataLainnya = await resLainnya.json();
            
            // Gabungkan semua data menjadi satu array
            const semuaProduk = [...dataPokok, ...dataMakanan, ...dataLainnya];
            
            // Masukkan data produk ke dalam elemen <select>
            selectProduk.innerHTML = '<option value="">-- Pilih Produk --</option>';
            semuaProduk.forEach(produk => {
                const option = document.createElement("option");
                option.value = produk.id;
                // Simpan stok dan harga di dalam atribut data-* untuk dibaca saat validasi
                option.dataset.stok = produk.stok;
                option.dataset.harga = produk.harga;
                option.textContent = `${produk.nama} (Sisa: ${produk.stok} ${produk.satuan})`;
                selectProduk.appendChild(option);
            });
        } catch (err) {
            selectProduk.innerHTML = '<option value="">Gagal memuat produk dari server</option>';
        }

        // Logika Validasi & Pemotongan Stok saat disubmit
        formKasir.addEventListener("submit", function (e) {
            e.preventDefault(); // Cegah halaman memuat ulang
            
            const pilihan = selectProduk.options[selectProduk.selectedIndex];
            
            if (!selectProduk.value) {
                alert("Silakan pilih produk terlebih dahulu!");
                return;
            }

            const jumlahBeli = parseInt(document.getElementById("jumlah-beli").value);
            const stokTersedia = parseInt(pilihan.dataset.stok);
            // Mengambil nama asli dari teks opsi (membuang teks " (Sisa: ...)")
            const namaProduk = pilihan.textContent.split(" (")[0]; 

            if (jumlahBeli > stokTersedia) {
                alert(`STOK TIDAK MENCUKUPI!\n\nSisa stok "${namaProduk}" hanya tinggal ${stokTersedia}.`);
            } else {
                const sisaStokBaru = stokTersedia - jumlahBeli;
                const totalBayar = jumlahBeli * parseInt(pilihan.dataset.harga);
                
                alert(`TRANSAKSI BERHASIL!\n\nProduk: ${namaProduk}\nJumlah Beli: ${jumlahBeli}\nTotal Bayar: Rp ${totalBayar.toLocaleString('id-ID')}\n\nSisa stok produk saat ini: ${sisaStokBaru}`);
                
                formKasir.reset(); // Kosongkan form setelah sukses
            }
        });
    }

    // B. Riwayat Transaksi (list.html)
    const tbodyTransaksi = document.getElementById("tbody-transaksi");
    const searchTransaksi = document.getElementById("search-input"); // Memanfaatkan ID pencarian yang sama

    if (tbodyTransaksi) {
        const urlJSON = tbodyTransaksi.getAttribute("data-json");
        let riwayatTransaksi = [];

        try {
            const res = await fetch(urlJSON);
            riwayatTransaksi = await res.json();
            renderRiwayat(riwayatTransaksi);
        } catch (err) {
            tbodyTransaksi.innerHTML = `<tr><td colspan="8" style="text-align:center;">Gagal memuat riwayat transaksi</td></tr>`;
        }

        function renderRiwayat(data) {
            tbodyTransaksi.innerHTML = "";
            if (data.length === 0) {
                tbodyTransaksi.innerHTML = `<tr><td colspan="8" style="text-align:center;">Belum ada transaksi</td></tr>`;
                return;
            }
            data.forEach(trx => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td><strong>${trx.id_nota}</strong></td>
                    <td>${trx.tanggal}</td>
                    <td>${trx.pembeli || 'Anonim'}</td>
                    <td>${trx.nama_produk}</td>
                    <td>${trx.jumlah}</td>
                    <td>Rp ${trx.total_bayar.toLocaleString('id-ID')}</td>
                    <td style="color: green; font-weight: bold;">${trx.status}</td>
                    <td><button type="button" class="btn-hapus">Batal</button></td>
                `;
                tbodyTransaksi.appendChild(tr);
            });
        }

        // Live Search khusus Riwayat Penjualan
        if (searchTransaksi) {
            searchTransaksi.addEventListener("keyup", function (e) {
                const kataKunci = e.target.value.toLowerCase();
                const hasilFilter = riwayatTransaksi.filter(item => 
                    item.id_nota.toLowerCase().includes(kataKunci) || 
                    item.pembeli.toLowerCase().includes(kataKunci)
                );
                renderRiwayat(hasilFilter);
            });
        }
    }
});