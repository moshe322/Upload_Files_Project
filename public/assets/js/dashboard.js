
// Load files when page opens
window.onload = loadFiles;

function uploadFile() {
    let fileInput = document.getElementById("fileInput");

    if (!fileInput.files[0]) {
        alert("Select file");
        return;
    }

    let formData = new FormData();
    formData.append("file", fileInput.files[0]);

    fetch("api/upload.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("msg").innerText = data.message;

        if (data.status === "success") {
            fileInput.value = "";

            // 🔥 THIS IS WHAT MAKES FILE APPEAR
            loadFiles();
        }
    });
}

function loadFiles() {
    fetch("api/list_files.php")
    .then(res => res.json())
    .then(data => {

        let list = document.getElementById("fileList");
        list.innerHTML = "";

        if (!data.files || data.files.length === 0) {
            list.innerHTML = "<li>No files uploaded</li>";
            return;
        }

        data.files.forEach(file => {
            let li = document.createElement("li");

            li.innerHTML = `
                📄 ${file}
                <a href="api/download.php?file=${file}" target="_blank">Download</a>
            `;

            list.appendChild(li);
        });
    });
}
