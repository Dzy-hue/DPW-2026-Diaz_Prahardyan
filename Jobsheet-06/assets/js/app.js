// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

function updateTableCounter() {
    const table = document.querySelector(".table-responsive table");
    const counterDiv = document.getElementById("table-counter");
    if (!table || !counterDiv) return;

    const semuaBaris = table.querySelectorAll("tbody tr");
    let jumlahTampil = 0;

    semuaBaris.forEach(function (row) {
        if (row.style.display !== "none") {
            jumlahTampil++;
        }
    });

    counterDiv.textContent = `Menampilkan ${jumlahTampil} dari ${semuaBaris.length} data`;
}

// Memakai event delegation di document karena baris tabel sekarang
// dirender dinamis via fetch (lihat buku.js/anggota.js) sehingga
// tombol .btn-hapus belum tentu ada saat DOMContentLoaded.
function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;

        const row = btn.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";            
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (yakin && row) {
            row.remove();

            // Perbarui teks counter jika fiturnya ada
            if (typeof updateTableCounter === "function") {
                updateTableCounter(); 
            }
        }
    });
}

// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const Keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const kolomJudul = row.querySelector("td");
            const teksJudul = kolomJudul ? kolomJudul.textContent.toLowerCase() : "";
            row.style.display = teksJudul.includes(Keyword) ? "" : "none";
        });

        // Perbarui teks counter jika fiturnya ada
        if (typeof updateTableCounter === "function") {
            updateTableCounter(); 
        }
    });
}

// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

// ===== Fungsi Utama: Validasi Form (Versi Refactor) =====
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // 1. Kumpulkan semua aturan dalam satu Array (Daftar)
        const daftarAturan = [
            { nama: "[name='judul'], [name='nama']", jenis: "wajib", pesan: "Field ini wajib diisi." },
            { nama: "[name='pengarang']", jenis: "wajib", pesan: "Nama pengarang wajib diisi." },
            { nama: "[name='tahun']", jenis: "tahun", pesan: "Tahun harus angka (1900-2026)." },
            { nama: "[name='stok']", jenis: "stok", pesan: "Stok tidak boleh bernilai negatif." },
            { nama: "[name='isbn']", jenis: "isbn", pesan: "ISBN hanya boleh berisi angka dan tanda hubung (-)." }
        ];

        // 2. Suruh JavaScript mengulang (looping) pengecekan ke setiap aturan di atas
        daftarAturan.forEach(function(item) {
            const field = form.querySelector(item.nama);
            
            // Lakukan pengecekan HANYA JIKA elemen tersebut ada di halaman ini
            if (field) { 
                let fieldValid = true;
                const nilaiTeks = field.value.trim();

                // 3. Tentukan logika pengecekan berdasarkan "jenis" aturan
                if (item.jenis === "wajib" && nilaiTeks === "") {
                    fieldValid = false;
                } 
                else if (item.jenis === "tahun") {
                    const angka = parseInt(nilaiTeks, 10);
                    if (isNaN(angka) || angka < 1900 || angka > 2026) fieldValid = false;
                } 
                else if (item.jenis === "stok") {
                    const angka = parseInt(nilaiTeks, 10);
                    if (isNaN(angka) || angka < 0) fieldValid = false;
                } 
                else if (item.jenis === "isbn" && nilaiTeks !== "") {
                    // ISBN opsional, jadi pola (regex) hanya dicek kalau kolomnya diisi
                    if (!/^[0-9-]+$/.test(nilaiTeks)) fieldValid = false;
                }

                // 4. Munculkan error atau hapus error berdasarkan hasil pengecekan di atas
                if (!fieldValid) {
                    tampilkanError(field, item.pesan);
                    valid = false;
                } else {
                    hapusError(field);
                }
            }
        });

        // 5. Jika ada minimal satu saja yang tidak valid, jegal proses simpannya!
        if (!valid) {
            e.preventDefault();
        }
    });
}

// Inisialisasi saat DOM siap
document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
    updateTableCounter(); // Tampilkan counter saat halaman pertama kali dimuat
});