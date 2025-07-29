import Ajax from "./util/ajax.js";

document.querySelectorAll(".add-to-cart-form").forEach((form) => {
    form.addEventListener("submit", async (e) => {

        e.preventDefault();
        
        const food_uuid = form.querySelector("input[name='food_uuid']").value;
        const quantityInput = form.querySelector("input[name='quantity']");
        const quantity = parseInt(quantityInput.value);

        if (!food_uuid || isNaN(quantity) || quantity < 1) {
            alert("Vui lòng nhập số lượng hợp lệ.");
            return;
        }

        try {
            const ajax = new Ajax();
            const res = await ajax.post("/api/cart/add", {
                food_uuid,
                quantity,
            });

            const json = await res.json();

            if (json.success) {
                const cartCountEl = document.querySelector("#cart-count");
                if (cartCountEl && json.cartCount !== undefined) {
                    cartCountEl.textContent = json.cartCount;
                }

                alert("Đã thêm vào giỏ hàng!");
            } else {
                alert("Thêm thất bại: " + (json.message || "Lỗi không xác định"));
            }
        } catch (error) {
            console.error("Lỗi khi thêm vào giỏ:", error);
            alert("Đã xảy ra lỗi khi thêm vào giỏ hàng.");
        }
    });
});
