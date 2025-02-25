document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.sidebar').addEventListener('click', function() {
        this.classList.toggle('expanded');
    });

    const searchInput = document.querySelector('.search-input');
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('.card h3').forEach(card => {
            const productName = card.textContent.toLowerCase();
            card.parentElement.style.display = productName.includes(query) ? 'block' : 'none';
        });
    });

    const sortButton = document.querySelector('.sort');
    sortButton.addEventListener('click', function() {
        // Sorting logic, e.g., based on date
    });

    // Select the logout link correctly
    const logoutLink = document.querySelector('.logout a');
    logoutLink.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default action
        const confirmLogout = confirm("Are you sure you want to logout?"); // Confirm logout
        if (confirmLogout) {
            window.location.href = 'logout.php'; // Redirect if confirmed
        }
    });
});
