document.addEventListener("DOMContentLoaded", function () {
    const navToggleBtn = document.getElementById("nav-toggle-btn");
    const mainNav = document.getElementById("main-nav");

    if (navToggleBtn && mainNav) {
        navToggleBtn.addEventListener("click", function () {
            mainNav.classList.toggle("nav-open");
        });
    }

    // Alur Card Beranda (index.html)
    const jmlProdukElem = document.getElementById("jml-produk");
    const jmlTransaksiElem = document.getElementById("jml-transaksi");
    const jmlKategoriElem = document.getElementById("jml-kategori");
    const jmlStokElem = document.getElementById("jml-stok");

    // Hanya jalankan jika elemen metrik ada di halaman ini (Beranda)
    if (jmlProdukElem && jmlTransaksiElem) {
        
        // Fungsi pembantu untuk mengambil data dari LocalStorage atau Fetch JSON
        async function fetchAtauLokal(keyPath) {
            const dataLokal = localStorage.getItem(keyPath);
            if (dataLokal) {
                return JSON.parse(dataLokal);
            } else {
                try {
                    // Gunakan path ./data/ karena index.html berada di root
                    // Berbeda dengan halaman list yang berada di dalam folder (menggunakan ../)
                    const pathRoot = keyPath.replace("../", "./"); 
                    const res = await fetch(pathRoot);
                    if (!res.ok) return [];
                    const data = await res.json();
                    localStorage.setItem(keyPath, JSON.stringify(data));
                    return data;
                } catch (e) {
                    return [];
                }
            }
        }

        async function muatMetrikDashboard() {
            // 1. Tarik semua data
            const dataPokok = await fetchAtauLokal("../data/kebutuhan-pokok.json");
            const dataMakanan = await fetchAtauLokal("../data/makanan-minuman.json");
            const dataLainnya = await fetchAtauLokal("../data/kebutuhan-lainnya.json");
            const dataTransaksi = await fetchAtauLokal("../data/transaksi.json");

            // Gabungkan semua array produk menjadi satu
            const semuaProduk = [...dataPokok, ...dataMakanan, ...dataLainnya];

            // 2. Lakukan perhitungan
            const totalProduk = semuaProduk.length;
            const totalTransaksi = dataTransaksi.length;
            const totalKategori = 3; // Karena ada 3 kategori / file
            
            // Hitung produk yang stoknya menipis (misal: <= 5)
            const stokMenipis = semuaProduk.filter(produk => produk.stok <= 5).length;

            // 3. Tampilkan ke HTML disertai animasi sederhana
            jmlProdukElem.textContent = totalProduk;
            jmlTransaksiElem.textContent = totalTransaksi;
            jmlKategoriElem.textContent = totalKategori;
            jmlStokElem.textContent = stokMenipis;
        }

        muatMetrikDashboard();
    }
});