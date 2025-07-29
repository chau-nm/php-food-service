import Ajax from "/assets/js/util/ajax.js";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".checkout-form");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const fullname = document.getElementById("fullname").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const address = document.getElementById("address").value.trim();
        const note = document.getElementById("note").value.trim();
        const paymentMethod = document.getElementById("payment_method").value;

        if (!fullname || !phone || !address || !paymentMethod) {
            return alert("Vui lòng nhập đầy đủ thông tin!");
        }

        try {
            const ajax = new Ajax();
            const response = await ajax.post("/api/checkout/process", {
                fullname,
                phone,
                address,
                note,
                payment_method: paymentMethod
            });

            if (!response.ok) {
                if (response.status === 401) {
                    alert("Phiên đăng nhập đã hết hạn hoặc chưa đăng nhập!");
                    window.location.href = "/login";
                    return;
                }
                alert("Lỗi server: " + response.status);
                return;
            }

            const json = await response.json();

            if (!json.success) {
                alert(json.message || "Đặt hàng thất bại, vui lòng thử lại!");
                return;
            }

            alert(json.message || "Đặt hàng thành công!");
            window.location.href = `/order-success?id=${json.order_id}`;
        } catch (error) {
            console.error("Checkout error:", error);
            alert("Có lỗi xảy ra khi kết nối với server!");
        }
    });
});
