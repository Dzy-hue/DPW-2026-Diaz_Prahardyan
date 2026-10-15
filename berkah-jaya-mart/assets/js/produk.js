document.addEventListener("DOMContentLoaded", async function () {
    const tbody = document.getElementById("tbody-produk");
    const loading = document.getElementById("loading-indicator");
    const searchInput = document.getElementById("search-input");

    if (!tbody) return; 

    const urlJSON = tbody.getAttribute("data-json");
    let dataProduk = [];

    // 1. Fetch Data JSON
    try {
        loading.style.display = "block";
        const res = await fetch(urlJSON);
        if (!res.ok) throw new Error("Gagal memuat data produk (Status " + res.status + ")");
        dataProduk = await res.json();
        renderTabel(dataProduk);
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:red;">${err.message}</td></tr>`;
    } finally {
        loading.style.display = "none";
    }

    // 2. Fungsi Render Tabel
    function renderTabel(data) {
        tbody.innerHTML = ""; 
        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Data tidak ditemukan</td></tr>`;
            return;
        }
        data.forEach((item) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${item.id || '-'}</td>
                <td>${item.nama}</td>
                <td>Rp ${item.harga.toLocaleString('id-ID')}</td>
                <td>${item.stok}</td>
                <td>${item.satuan}</td>
                <td><button type="button" class="btn-hapus">Hapus</button></td>
            `;
            tbody.appendChild(tr);
        });
    }

    // 3. Live Search (Pencarian)
    if (searchInput) {
        searchInput.addEventListener("keyup", function (e) {
            const kataKunci = e.target.value.toLowerCase();
            const hasilFilter = dataProduk.filter(item => 
                item.nama.toLowerCase().includes(kataKunci)
            );
            renderTabel(hasilFilter);
        });
    }

    // 4. Event Delegation untuk Tombol Hapus
    tbody.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-hapus")) {
            const baris = e.target.closest("tr");
            const namaProduk = baris.children[1].textContent;
            const yakin = confirm(`Yakin ingin menghapus produk "${namaProduk}"?`);
            if (yakin && baris) {
                baris.remove(); 
            }
        }
    });
});