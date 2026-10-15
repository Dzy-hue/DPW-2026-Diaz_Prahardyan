document.addEventListener("DOMContentLoaded", function () {
    const tbody = document.getElementById("tbody-produk");
    const loading = document.getElementById("loading-indicator");
    const searchInput = document.getElementById("search-input");
    const formTambah = document.getElementById("form-tambah");
    const infoTampil = document.getElementById("info-tampil");

    let storageKey = "data_produk";
    if (tbody) {
        storageKey = tbody.getAttribute("data-json");
    } else if (formTambah) {
        if (window.location.pathname.includes('kebutuhan-pokok')) storageKey = "../data/kebutuhan-pokok.json";
        else if (window.location.pathname.includes('makanan-minuman')) storageKey = "../data/makanan-minuman.json";
        else if (window.location.pathname.includes('kebutuhan-lainnya')) storageKey = "../data/kebutuhan-lainnya.json";
    }

    // ==========================================
    // INIT VALIDASI FORM (Fungsi Global)
    // ==========================================
    function initValidasiForm(formElem) {
        if (!formElem) return;
        
        // Memantau semua input dan select di dalam form
        const inputs = formElem.querySelectorAll("input, select");
        inputs.forEach(input => {
            // Saat user mulai mengetik/memilih, hilangkan warna merah error
            input.addEventListener("input", function () {
                this.style.borderColor = ""; 
                this.style.backgroundColor = "";
            });
        });

        return function validasiKosong(fieldIds) {
            let isValid = true;
            fieldIds.forEach(id => {
                const elemen = document.getElementById(id);
                if (elemen && !elemen.value.trim()) {
                    // Jika kosong, ubah garis tepi jadi merah
                    elemen.style.borderColor = "#ef4444";
                    elemen.style.backgroundColor = "#fee2e2";
                    isValid = false;
                }
            });
            return isValid;
        };
    }

    // Inisialisasi fungsi validasi khusus form tambah produk
    const cekValidasiTambah = initValidasiForm(formTambah);

    // ==========================================
    // BAGIAN 1: LOGIKA DAFTAR PRODUK (TABEL)
    // ==========================================
    if (tbody) {
        let dataProduk = [];
        
        // Menampilkan tulisan "Memuat data..." dan menyembunyikan tabel
        if (loading) loading.style.display = "block";
        tbody.style.opacity = "0.3"; // Membuat tabel menjadi buram saat memuat
        
        // Membuat JEDA BUATAN selama 800ms (0.8 detik) agar animasi loading terlihat
        setTimeout(async () => {
            const localData = localStorage.getItem(storageKey);
            
            if (localData) {
                dataProduk = JSON.parse(localData);
                renderTabel(dataProduk);
            } else {
                try {
                    const res = await fetch(storageKey);
                    if (!res.ok) throw new Error("Gagal memuat data");
                    dataProduk = await res.json();
                    
                    localStorage.setItem(storageKey, JSON.stringify(dataProduk));
                    renderTabel(dataProduk);
                } catch (err) {
                    tbody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:red;">${err.message}</td></tr>`;
                }
            }

            // Mematikan tulisan "Memuat data..." dan menormalkan tabel
            if (loading) loading.style.display = "none";
            tbody.style.opacity = "1"; 

        }, 800); // <-- 800ms adalah lama waktu loading

        function renderTabel(data) {
            tbody.innerHTML = ""; 

            // LOGIKA BARU: Update teks "Menampilkan X dari Y"
            if (infoTampil) {
                infoTampil.textContent = `Menampilkan ${data.length} dari ${dataProduk.length} produk`;
            }

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Data tidak ditemukan</td></tr>`;
                return;
            }
            
            data.forEach((item, index) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${item.id || '-'}</td>
                    <td>${item.nama}</td>
                    <td>Rp ${parseInt(item.harga).toLocaleString('id-ID')}</td>
                    <td>${item.stok}</td>
                    <td>${item.satuan}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <button type="button" class="btn-edit" data-index="${index}" style="background-color: #f59e0b; color: white; padding: 0.4rem 0.8rem; border: none; border-radius: 4px; cursor: pointer; font-size: 0.85rem; font-weight: 600;">Edit</button>
                            <button type="button" class="btn-hapus" data-index="${index}">Hapus</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        if (searchInput) {
            searchInput.addEventListener("keyup", function (e) {
                const kataKunci = e.target.value.toLowerCase();
                const hasilFilter = dataProduk.filter(item => 
                    item.nama.toLowerCase().includes(kataKunci)
                );
                renderTabel(hasilFilter);
            });
        }

        tbody.addEventListener("click", function (e) {
            const index = e.target.getAttribute("data-index");
            
            if (e.target.classList.contains("btn-hapus")) {
                const namaProduk = dataProduk[index].nama;
                if (confirm(`Yakin ingin menghapus produk "${namaProduk}"?`)) {
                    dataProduk.splice(index, 1); 
                    localStorage.setItem(storageKey, JSON.stringify(dataProduk)); 
                    renderTabel(dataProduk); 
                }
            } 
            else if (e.target.classList.contains("btn-edit")) {
                const item = dataProduk[index];
                const namaBaru = prompt("Ubah Nama Produk:", item.nama);
                if (namaBaru === null) return; 
                
                const hargaBaru = prompt("Ubah Harga Satuan (Hanya Angka):", item.harga);
                if (hargaBaru === null) return;
                
                const stokBaru = prompt("Ubah Sisa Stok (Hanya Angka):", item.stok);
                if (stokBaru === null) return;

                dataProduk[index].nama = namaBaru;
                dataProduk[index].harga = parseInt(hargaBaru);
                dataProduk[index].stok = parseInt(stokBaru);
                
                localStorage.setItem(storageKey, JSON.stringify(dataProduk)); 
                renderTabel(dataProduk); 
            }
        });
    }

    // ==========================================
    // BAGIAN 2: LOGIKA FORM TAMBAH PRODUK
    // ==========================================
    if (formTambah) {
        formTambah.addEventListener("submit", function (e) {
            e.preventDefault(); 
            
            // Panggil validasi (Cek input dengan ID 'nama', 'harga', 'stok')
            const isLengkap = cekValidasiTambah(['nama', 'harga', 'stok']);
            
            if (!isLengkap) {
                alert("Gagal! Harap isi semua data yang bertanda warna merah.");
                return;
            }

            const nama = document.getElementById("nama").value;
            const harga = document.getElementById("harga").value;
            const stok = document.getElementById("stok").value;
            const satuan = document.getElementById("satuan") ? document.getElementById("satuan").value : "Pcs";

            let dataProduk = [];
            const localData = localStorage.getItem(storageKey);
            if (localData) {
                dataProduk = JSON.parse(localData);
            }

            const newId = "PRD-" + Math.floor(Math.random() * 1000);

            dataProduk.push({
                id: newId,
                nama: nama,
                harga: parseInt(harga),
                stok: parseInt(stok),
                satuan: satuan
            });

            localStorage.setItem(storageKey, JSON.stringify(dataProduk));

            alert(`SUKSES!\nProduk "${nama}" berhasil disimpan.`);
            formTambah.reset(); 
        });
    }
});