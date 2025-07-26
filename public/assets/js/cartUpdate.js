import Ajax from "/assets/js/util/ajax.js";

document.addEventListener("DOMContentLoaded", () => {
    const inputs = document.querySelectorAll(".cart-quantity");

    inputs.forEach(input => {
        input.addEventListener("change", async () => {
            const food_uuid = input.dataset.id;
            const quantity = parseInt(input.value);

            if (isNaN(quantity) || quantity < 1) {
                alert("❌ Số lượng không hợp lệ. Phải lớn hơn 0.");
                input.value = 1;
                return;
            }

            try {
                const ajax = new Ajax();
                const response = await ajax.post("/api/cart/update", {
                    food_uuid,
                    quantity
                });

                const json = await response.json();
                if (json.success) {
                    location.reload();
                } else {
                    alert("❌ Cập nhật thất bại: " + (json.message || ""));
                }
            } catch (error) {
                console.error("Lỗi khi gửi request cập nhật:", error);
                alert("⚠️ Lỗi máy chủ khi cập nhật giỏ hàng.");
            }
        });
    });
});
