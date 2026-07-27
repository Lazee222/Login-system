// Show / Hide Password
function togglePassword(id, icon) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🔍"; // Password is visible
    } else {
        input.type = "password";
        icon.textContent = "👁"; // Password is hidden
    }
}