

var inactivityTimeout;
var inactivityDuration = 3 * 60 * 1000;

// List of pages where the session timeout should not be active
var excludedPages = [
    'retrieve-IDs.php',
];

// Get the current page URL
var currentPage = window.location.pathname.split('/').pop();

if (!excludedPages.includes(currentPage)) {
    function resetInactivityTimer() {
        clearTimeout(inactivityTimeout);
        inactivityTimeout = setTimeout(logout, inactivityDuration);
    }

    document.addEventListener("mousemove", resetInactivityTimer);
    document.addEventListener("keypress", resetInactivityTimer);

    function logout() {
        alert("Session timed out. Logging out.");
        window.location.href = "/Web24/login.php"; 
    }
}
