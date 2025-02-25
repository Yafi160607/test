document.getElementById("menu-button").addEventListener("click", function() {
    const dropdown = document.getElementById("dropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
  });
  
  window.addEventListener("click", function(event) {
    if (!event.target.closest("#menu-button") && !event.target.closest("#dropdown")) {
      const dropdown = document.getElementById("dropdown");
      dropdown.style.display = "none";
    }
  });
  