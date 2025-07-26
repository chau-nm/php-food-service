import Ajax from "./util/ajax.js";

document.querySelectorAll(".cart-quantity").forEach((input) => {
    input.addEventListener("change", async (e) => {
        const quantity = parseInt(input.value);
        const id = input.dataset.id;

        if (isNaN(quantity) || quantity < 1) return;

        const ajax = new Ajax();
        const res = await ajax.post("/cart", {
            action: "update",
            id,
            quantity
        });

        try {
            const json = await res.json();
            if (json.success) {
                const row = input.closest("tr");
                const itemTotalCell = row.querySelector(".item-total");
                if (itemTotalCell) {
                    itemTotalCell.textContent = Number(json.itemTotal).toLocaleString("vi-VN") + " VND";
                }

                const totalElement = document.querySelector(".total-payment strong");
                if (totalElement) {
                    totalElement.textContent = Number(json.total).toLocaleString("vi-VN") + " VND";
                }
            } else {
                alert("❌ Cập nhật thất bại: " + (json.message || ""));
            }
        } catch (err) {
            console.error("Lỗi xử lý JSON:", err);
            alert("⚠️ Không thể cập nhật số lượng.");
        }
    });
});
