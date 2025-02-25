document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.querySelector('.sidebar');
  const dropdown = document.querySelector('.dropdown');
  const dropdownContent = document.getElementById('dropdown');  // Ensure this ID matches in HTML
  const logoutLink = document.querySelector('.logout a');

  // Toggle sidebar expansion on sidebar click
  sidebar.addEventListener('click', function() {
    this.classList.toggle('expanded');
  });

  // Handle logout confirmation
  logoutLink.addEventListener('click', function(e) {
    e.preventDefault();
    const confirmLogout = confirm("Are you sure you want to logout?");
    if (confirmLogout) {
      window.location.href = '../php/logout.php';
    }
  });

  // Toggle dropdown visibility when "Menu" is clicked
  dropdown.addEventListener('click', function(e) {
    e.stopPropagation(); // Prevent event from propagating to other elements
    const isDropdownVisible = dropdownContent.style.display === 'block';

    // Toggle dropdown and expanded sidebar
    if (isDropdownVisible) {
      dropdownContent.style.display = 'none';
    } else {
      dropdownContent.style.display = 'block';
      sidebar.classList.add('expanded');
    }
  });

  // Close dropdown when a dropdown item is clicked
  dropdownContent.querySelectorAll('a').forEach((item) => {
    item.addEventListener('click', function() {
      dropdownContent.style.display = 'none';
      sidebar.classList.remove('expanded');
    });
  });

  // Close sidebar and dropdown if clicking outside of them
  document.addEventListener('click', function(e) {
    if (!sidebar.contains(e.target)) {
      dropdownContent.style.display = 'none'; // Close dropdown
      sidebar.classList.remove('expanded'); // Close sidebar
    }
  });
});
