import Ajax from "./util/ajax.js";

const logoutBtn = document.getElementById("logoutBtn");

if (logoutBtn) {
    logoutBtn.addEventListener("click", async (e) => {
        e.preventDefault();

        const ajax = new Ajax();
        const response = await ajax.post("/auth/logout");

        if (response.ok) {
            location.href = "/login";
            location.reload();
        } else {
            alert("Đăng xuất thất bại!");
        }
    });
}
