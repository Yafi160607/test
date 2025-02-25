document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const dropdown = document.querySelector(".dropdown");
    const dropdownContent = document.getElementById("dropdown");

    // Event listener untuk toggle sidebar dan dropdown saat tombol Menu ditekan
    dropdown.addEventListener("click", function (e) {
      e.stopPropagation(); // Mencegah event ini menyebar ke elemen lain
      const isDropdownVisible = dropdownContent.style.display === "block";

      // Toggle dropdown dan sidebar terbuka
      if (isDropdownVisible) {
        dropdownContent.style.display = "none";
        sidebar.classList.remove("expanded");
      } else {
        dropdownContent.style.display = "block";
        sidebar.classList.add("expanded");
      }
    });

    // Menutup sidebar saat salah satu item di dropdown diklik
    sidebar.querySelectorAll(".dropdown-content a").forEach((item) => {
      item.addEventListener("click", function () {
        dropdownContent.style.display = "none";
        sidebar.classList.remove("expanded");
      });
    });

    // Event listener untuk menutup sidebar jika klik di luar sidebar dan dropdown
    document.addEventListener("click", function (e) {
      // Cek apakah yang diklik bukan sidebar atau dropdown
      if (!sidebar.contains(e.target) && !dropdown.contains(e.target)) {
        dropdownContent.style.display = "none"; // Menutup dropdown
        sidebar.classList.remove("expanded"); // Menutup sidebar
      }
    });
  });
