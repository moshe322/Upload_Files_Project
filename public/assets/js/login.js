function login() {
    fetch("api/login.php", {
        method: "POST",
        body: JSON.stringify({
            email: document.getElementById("email").value,
            password: document.getElementById("password").value
        })
    })
    .then(r=>r.json())
    .then(d=>{
        document.getElementById("msg").innerText = d.message;

        if(d.status === "otp_sent"){
            document.getElementById("otpBox").style.display = "block";
        }
    });
}

function verifyOTP() {
    fetch("api/verify_otp.php", {
        method: "POST",
        body: JSON.stringify({
            otp: document.getElementById("otp").value
        })
    })
    .then(r=>r.json())
    .then(d=>{
        document.getElementById("msg").innerText = d.message;

        if(d.status === "success"){
            window.location.href = "dashboard.html";
        }
    });
}
