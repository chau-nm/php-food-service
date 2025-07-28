import Ajax from "./util/ajax.js";

const signupForm = document.getElementById("signup-form");

signupForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(signupForm);
    const data = Object.fromEntries(formData.entries());

    const ajax = new Ajax();
    const response = await ajax.post("/api/auth/register", data);
    const responseData = await response.json();
    if (response.ok) {
        alert("Đăng ký thành công");
        location.href = "/login";
    } else {
        alert(responseData.message);
    }
});