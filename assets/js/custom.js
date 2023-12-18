// ... (kode sebelumnya) ...

function openModal(modalId) {
  $("#" + modalId).modal("show");
}

function showNoteModal(element) {
  var note = $(element).data("note");
  $("#noteModalTitle").text("*NOTE*");
  $("#noteModalContent").text(note);
  $("#noteModal").modal("show");
}

function showImageModal(imageName) {
  if (imageName) {
    $("#imageModalTitle").text("Show Image");
    $("#imageModalImage").attr("src", "../img/" + imageName);
    $("#imageModal").modal("show");
  } else {
    $("#imageModalTitle").text("Tidak Ada Gambar");
    $("#imageModalImage").attr("src", "");
    $("#imageModalContent").text("Maaf, tidak ada gambar yang tersedia.");
    $("#imageModal").modal("show");
  }
}

function closeImageModal() {
  $("#imageModal").modal("hide");
}

var isSearching = false; // Tambahkan variabel untuk mengidentifikasi mode pencarian

function refreshContent() {
  var searchKeyword = "";
  if (isSearching) {
    // Ambil nilai kata kunci pencarian jika sedang dalam mode pencarian
    searchKeyword = $("#keyword").val();
  }

  $.ajax({
    url: "refresh_content.php", // Ganti dengan URL yang sesuai
    method: "GET",
    dataType: "html",
    data: { keyword: searchKeyword, clearSearch: !isSearching }, // Kirim kata kunci pencarian dan flag clearSearch ke server
    success: function (data) {
      $("#contain").html(data);
      if (!isSearching) {
        // Jika tidak sedang dalam mode pencarian, bersihkan nilai pencarian
        $("#keyword").val("");
      }
    },
    error: function () {
      console.error("Gagal memuat konten.");
    },
  });
}

setInterval(refreshContent, 10000);

function detailModal(customerId) {
  // Kirim request AJAX untuk mendapatkan data customer berdasarkan ID
  $.ajax({
    url: "get_customer_data.php", // Ganti dengan file yang sesuai
    method: "POST",
    data: { id: customerId },
    dataType: "json",
    success: function (data) {
      // Isi modal detail dengan data customer yang diterima
      $("#customerDetailContent").html(
        "<p>Kode Plat: " +
          data.kode_plat +
          "</p>" +
          "<p>Nama Customer: " +
          data.nama +
          "</p>" +
          "<p>Kode Barang: " +
          data.kode_barang +
          "</p>" +
          "<p>Nama Barang: " +
          data.nama_barang +
          "</p>" +
          "<p>No. Telepon: " +
          data.telepon +
          "</p>" +
          "<p>Tanggal Pemesanan: " +
          data.pesan +
          "</p>" +
          "<p>Tanggal Ready: " +
          data.ready +
          "</p>" +
          "<p>Note: " +
          data.note +
          "</p>"
      );

      // Tampilkan modal detail
      $("#customerDetailModal").modal("show");
    },
    error: function () {
      console.error("Gagal mengambil data customer untuk detail.");
    },
  });
}

$(document).on("click", ".customer-detail", function (e) {
  e.preventDefault();
  var customerId = $(this).data("id");
  detailModal(customerId);
});

// Menutup modal saat tombol 'x' di-klik
$(".modal-header button").on("click", function () {
  $(this).closest(".modal").modal("hide");
});
