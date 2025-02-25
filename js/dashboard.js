// Inisialisasi variabel
let currentIndex = 0; // Slide aktif
const items = document.querySelectorAll(".carousel-item"); // Semua slide
const totalItems = items.length; // Total slide
const carouselInner = document.querySelector(".carousel-inner"); // Wrapper slide

// Fungsi untuk menampilkan slide berdasarkan indeks
function showSlide(index) {
  if (index >= totalItems) {
    currentIndex = 0; // Kembali ke slide pertama
  } else if (index < 0) {
    currentIndex = totalItems - 1; // Kembali ke slide terakhir
  } else {
    currentIndex = index; // Update slide aktif
  }

  // Geser carousel secara horizontal
  const offset = -currentIndex * 100; // Hitung offset berdasarkan index
  carouselInner.style.transform = `translateX(${offset}%)`;

  // Perbarui indikator aktif
  const indicators = document.querySelectorAll(".carousel-indicators button");
  indicators.forEach((indicator) => indicator.classList.remove("active"));
  indicators[currentIndex].classList.add("active");
}

// Fungsi untuk slide berikutnya
function nextSlide() {
  showSlide(currentIndex + 1);
}

// Fungsi untuk slide sebelumnya
function prevSlide() {
  showSlide(currentIndex - 1);
}

// Tambahkan event listener untuk tombol navigasi
document
  .querySelector(".carousel-control-next")
  .addEventListener("click", nextSlide);
document
  .querySelector(".carousel-control-prev")
  .addEventListener("click", prevSlide);

// Tambahkan event listener untuk tombol indikator
const indicators = document.querySelectorAll(".carousel-indicators button");
indicators.forEach((indicator, index) => {
  indicator.addEventListener("click", () => showSlide(index));
});

// (Opsional) Auto-slide setiap 5 detik
setInterval(nextSlide, 5000);
