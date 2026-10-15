document.addEventListener("DOMContentLoaded", async function () {
    
    // Kunci untuk memori transaksi
    const trxStorageKey = "../data/transaksi.json";

    // Alur Form Tambah (tambah.html)
    const formKasir = document.getElementById("form-kasir");
    const selectProduk = document.getElementById("pilih-produk");

    if (formKasir && selectProduk) {    
        // Cek memori (localStorage) dulu, jika kosong baru ambil dari file JSON
        async function getProdukData(keyPath) {
            const localData = localStorage.getItem(keyPath);
            if (localData) {
                return JSON.parse(localData);
            } else {
                try {
                    const res = await fetch(keyPath);
                    const data = await res.json();
                    localStorage.setItem(keyPath, JSON.stringify(data)); // Simpan awal ke memori
                    return data;
                } catch (e) {
                    return [];
                }
            }
        }
        // Ambil data produk menggunakan fungsi pembantu di atas
        try {
            const dataPokok = await getProdukData("../data/kebutuhan-pokok.json");
            const dataMakanan = await getProdukData("../data/makanan-minuman.json");
            const dataLainnya = await getProdukData("../data/kebutuhan-lainnya.json");
            
            // Gabungkan semua data menjadi satu array
            const semuaProduk = [...dataPokok, ...dataMakanan, ...dataLainnya];
            
            // Masukkan data produk ke dalam elemen <select>
            selectProduk.innerHTML = '<option value="">-- Pilih Produk --</option>';
            semuaProduk.forEach(produk => {
                const option = document.createElement("option");
                option.value = produk.id;
                option.dataset.stok = produk.stok;
                option.dataset.harga = produk.harga;
                option.textContent = `${produk.nama} (Sisa: ${produk.stok} ${produk.satuan})`;
                selectProduk.appendChild(option);
            });
        } catch (err) {
            selectProduk.innerHTML = '<option value="">Gagal memuat produk</option>';
        }

        // ... (Logika formKasir.addEventListener("submit", ...) tetap sama di bawahnya)

        // Logika Validasi & Menyimpan ke LocalStorage
        formKasir.addEventListener("submit", function (e) {
            e.preventDefault(); 
            
            const pilihan = selectProduk.options[selectProduk.selectedIndex];
            
            if (!selectProduk.value) {
                alert("Silakan pilih produk terlebih dahulu!");
                return;
            }

            const jumlahBeli = parseInt(document.getElementById("jumlah-beli").value);
            const namaPembeliElem = document.getElementById("nama-pembeli");
            const namaPembeli = namaPembeliElem && namaPembeliElem.value ? namaPembeliElem.value : "Anonim";
            
            const stokTersedia = parseInt(pilihan.dataset.stok);
            const namaProduk = pilihan.textContent.split(" (")[0]; 

            if (jumlahBeli > stokTersedia) {
                alert(`STOK TIDAK MENCUKUPI!\n\nSisa stok "${namaProduk}" hanya tinggal ${stokTersedia}.`);
            } else {
                const totalBayar = jumlahBeli * parseInt(pilihan.dataset.harga);
                
                // 1. Ambil data riwayat transaksi lama dari memori
                let riwayatLama = [];
                const localTrx = localStorage.getItem(trxStorageKey);
                if (localTrx) {
                    riwayatLama = JSON.parse(localTrx);
                }

                // 2. Buat Format ID Nota (Contoh: TRX-20261015-89)
                const dateObj = new Date();
                const tgl = dateObj.toISOString().split('T')[0]; // Format YYYY-MM-DD
                const tglString = tgl.replace(/-/g, '');
                const randomNum = Math.floor(Math.random() * 100).toString().padStart(2, '0');
                const idNota = `TRX-${tglString}-${randomNum}`;

                // 3. Buat Objek Transaksi Baru
                const transaksiBaru = {
                    id_nota: idNota,
                    tanggal: tgl,
                    pembeli: namaPembeli,
                    nama_produk: namaProduk,
                    jumlah: jumlahBeli,
                    total_bayar: totalBayar,
                    status: "Proses Pembayaran" 
                };

                // 4. Masukkan ke array dan simpan kembali ke memori
                riwayatLama.unshift(transaksiBaru); // unshift agar muncul di urutan paling atas
                localStorage.setItem(trxStorageKey, JSON.stringify(riwayatLama));

                alert(`TRANSAKSI BERHASIL DISIMPAN!\n\nNo Nota: ${idNota}\nProduk: ${namaProduk}\nTotal Bayar: Rp ${totalBayar.toLocaleString('id-ID')}\nStatus: Proses Pembayaran`);
                
                formKasir.reset(); 
            }
        });
    }

    //Alur Daftar Transaksi(list.html)
    const tbodyTransaksi = document.getElementById("tbody-transaksi");
    const searchTransaksi = document.getElementById("search-input"); 
    const infoTampil = document.getElementById("info-tampil"); 
    const loading = document.getElementById("loading-indicator"); // Tambahkan penangkap ID loading

    if (tbodyTransaksi) {
        let riwayatTransaksi = [];
        
        // 1. Munculkan teks loading dan buat tabel menjadi buram
        if (loading) loading.style.display = "block";
        tbodyTransaksi.style.opacity = "0.3";
        
        // 2. Beri jeda 800ms (0,8 detik) agar animasi loading terlihat
        setTimeout(async () => {
            const localData = localStorage.getItem(trxStorageKey);
            
            if (localData) {
                riwayatTransaksi = JSON.parse(localData);
                renderRiwayat(riwayatTransaksi);
            } else {
                try {
                    const res = await fetch(trxStorageKey);
                    riwayatTransaksi = await res.json();
                    localStorage.setItem(trxStorageKey, JSON.stringify(riwayatTransaksi));
                    renderRiwayat(riwayatTransaksi);
                } catch (err) {
                    tbodyTransaksi.innerHTML = `<tr><td colspan="8" style="text-align:center; color:red;">Gagal memuat riwayat transaksi</td></tr>`;
                }
            }

            // 3. Matikan teks loading dan kembalikan tabel menjadi jelas
            if (loading) loading.style.display = "none";
            tbodyTransaksi.style.opacity = "1";
            
        }, 800); // <-- Waktu jeda (800ms)

        // 4. Fungsi render tabel (Tetap sama seperti yang sudah Anda buat sebelumnya)
        function renderRiwayat(data) {
            tbodyTransaksi.innerHTML = "";

            if (infoTampil) {
                infoTampil.textContent = `Menampilkan ${data.length} dari ${riwayatTransaksi.length} transaksi`;
            }

            if (data.length === 0) {
                tbodyTransaksi.innerHTML = `<tr><td colspan="8" style="text-align:center;">Belum ada transaksi</td></tr>`;
                return;
            }
            
            data.forEach((trx, index) => {
                const tr = document.createElement("tr");
                
                let warnaStatus = "green";
                let kolomAksi = `<span style="color: #94a3b8; font-style: italic; font-size: 0.9rem;">-</span>`;
                
                if (trx.status.toLowerCase() === "proses pembayaran") {
                    warnaStatus = "orange";
                    kolomAksi = `
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <button type="button" class="btn-selesai" data-index="${index}" style="background-color: #10b981; color: white; padding: 0.4rem 0.6rem; border: none; border-radius: 4px; cursor: pointer; font-size: 0.85rem; font-weight: 600;">Selesai</button>
                            <button type="button" class="btn-hapus" data-index="${index}">Batal</button>
                        </div>
                    `;
                }
                
                tr.innerHTML = `
                    <td><strong>${trx.id_nota}</strong></td>
                    <td>${trx.tanggal}</td>
                    <td>${trx.pembeli || 'Anonim'}</td>
                    <td>${trx.nama_produk}</td>
                    <td>${trx.jumlah}</td>
                    <td>Rp ${parseInt(trx.total_bayar).toLocaleString('id-ID')}</td>
                    <td style="color: ${warnaStatus}; font-weight: bold;">${trx.status}</td>
                    <td>${kolomAksi}</td>
                `;
                tbodyTransaksi.appendChild(tr);
            });
        }
                
        // 3. Pencarian Riwayat
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

        // 4. Logika Tombol Aksi (Batal & Selesai)
        tbodyTransaksi.addEventListener("click", async function (e) {
            const index = e.target.getAttribute("data-index");
            if (index === null) return; // Jika yang diklik bukan tombol, hentikan

            const trxTerpilih = riwayatTransaksi[index];
            const status = trxTerpilih.status.toLowerCase();

            // Jika Tombol Batal Di-klik
            if (e.target.classList.contains("btn-hapus")) {
                // Cek status, tolak jika sudah "selesai"
                if (status === "selesai") {
                    alert("TINDAKAN DITOLAK!\nTransaksi yang berstatus 'Selesai' sudah tercatat secara permanen dan tidak dapat dibatalkan.");
                    return;
                }

                // Izinkan jika status masih "proses pembayaran"
                if (status === "proses pembayaran") {
                    const yakin = confirm(`Yakin ingin membatalkan pesanan dengan No Nota "${trxTerpilih.id_nota}"?`);
                    if (yakin) {
                        riwayatTransaksi.splice(index, 1); // Hapus data dari array
                        localStorage.setItem(trxStorageKey, JSON.stringify(riwayatTransaksi)); // Update memori
                        renderRiwayat(riwayatTransaksi); // Render ulang tabel
                        alert("Transaksi berhasil dibatalkan dan dihapus dari riwayat.");
                    }
                }
            }

            // Jika Tombol Selesai Di-klik + Otomatis Pemotongan Stok 
            if (e.target.classList.contains("btn-selesai")) {
                const konfirmasiSelesai = confirm(`Konfirmasi pembayaran untuk No Nota "${trxTerpilih.id_nota}"?\n\nJika dikonfirmasi, transaksi tidak bisa dibatalkan lagi dan STOK PRODUK AKAN BERKURANG secara otomatis.`);
                
                if (konfirmasiSelesai) {
                    // 1. Ubah status transaksi menjadi "Selesai"
                    riwayatTransaksi[index].status = "Selesai";
                    
                    // 2. Cari produk di semua kategori dan POTONG STOKNYA
                    const kategoriKeys = [
                        "../data/kebutuhan-pokok.json", 
                        "../data/makanan-minuman.json", 
                        "../data/kebutuhan-lainnya.json"
                    ];
                    
                    for (let key of kategoriKeys) {
                        let dataProdukArray = [];
                        const localProduk = localStorage.getItem(key);
                        
                        // Cek apakah memori produk sudah ada, jika belum muat dari file aslinya
                        if (localProduk) {
                            dataProdukArray = JSON.parse(localProduk);
                        } else {
                            try {
                                const res = await fetch(key);
                                dataProdukArray = await res.json();
                            } catch(err) { continue; }
                        }
                        
                        // Cari produk yang namanya persis dengan yang ada di nota
                        const indexProduk = dataProdukArray.findIndex(p => p.nama === trxTerpilih.nama_produk);
                        
                        if (indexProduk !== -1) {
                            // Jika ketemu, kurangi stoknya
                            dataProdukArray[indexProduk].stok -= parseInt(trxTerpilih.jumlah);
                            
                            // Cegah stok menjadi minus (opsional)
                            if (dataProdukArray[indexProduk].stok < 0) {
                                dataProdukArray[indexProduk].stok = 0;
                            }
                            
                            // Simpan kembali data produk terbaru ke memori (localStorage)
                            localStorage.setItem(key, JSON.stringify(dataProdukArray));
                            break; // Hentikan pencarian karena produk sudah ditemukan & dipotong
                        }
                    }
                    
                    // 3. Simpan riwayat transaksi dan perbarui tabel di layar
                    localStorage.setItem(trxStorageKey, JSON.stringify(riwayatTransaksi));
                    renderRiwayat(riwayatTransaksi); 
                    
                    alert("Pembayaran berhasil dikonfirmasi!\nStok produk bersangkutan telah dikurangi secara otomatis.");
                }
            }
        });
    }
});