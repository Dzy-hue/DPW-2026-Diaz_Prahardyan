function muatDataBuku() {
    muatTabelData("../data/buku.json", ["judul", "pengarang", "tahun", "stok"]);
}

document.addEventListener("DOMContentLoaded", function() {
    muatDataBuku();

    // Kaitkan tombol Muat Ulang dengan fungsi pengambilan data
    const btnReload = document.getElementById("btn-reload");
    if (btnReload) {
        btnReload.addEventListener("click", muatDataBuku);
    }
});