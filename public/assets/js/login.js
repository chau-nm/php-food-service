import Ajax from "./util/ajax.js";

const loginForm = document.getElementById("login-form");

loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(loginForm);
    const data = Object.fromEntries(formData.entries());

    const ajax = new Ajax();
    const response = await ajax.post("/auth/login", data);
    const responseData = await response.json();
    if (response.ok) {
        alert("Đăng nhập thành công");
        location.href = "/";
    } else {
        alert(responseData.message);
    }
});