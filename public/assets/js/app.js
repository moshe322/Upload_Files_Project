// Base URL (adjust if needed)
const API_BASE = "api/";

// 🔹 LOGIN
function login() {
    fetch(API_BASE + "login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            email: document.getElementById("loginEmail").value,
            password: document.getElementById("loginPassword").value
        })
    })
    .then(res => res.json())
    .then(data => {
        showMessage(data.message, data.status);

        // ✅ ADD THIS
        if (data.status === "success") {
            setTimeout(() => {
                window.location.href = "dashboard.html";
            }, 1000);
        }
    })
    .catch(() => {
        showMessage("Server error", "error");
    });
}
// 🔹 SIGNUP
function signup() {
    fetch(API_BASE + "signup.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            username: document.getElementById("signupUsername").value,
            email: document.getElementById("signupEmail").value,
            password: document.getElementById("signupPassword").value
        })
    })
    .then(res => res.json())
    .then(data => {
        showMessage(data.message, data.status);

        // ✅ redirect after success
        if (data.status === "success") {
            setTimeout(() => {
                window.location.href = "login.html";
            }, 1000);
        }
    })
    .catch(() => {
        showMessage("Server error", "error");
    });
}
// 🔹 Message Display
function showMessage(msg, status) {
    const el = document.getElementById("message");
    el.innerText = msg;

    if (status === "success") {
        el.style.color = "green";
    } else {
        el.style.color = "red";
    }
}
