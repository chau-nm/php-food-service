import Ajax from "./util/ajax.js";

document.querySelectorAll(".btn-remove").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
        e.preventDefault();

        const uuid = btn.dataset.foodUuid;
        const ajax = new Ajax();
        const res = await ajax.post("/api/cart/remove", { food_uuid: uuid });

        const json = await res.json();

        btn.closest("tr")?.remove();

        document.getElementById("cart-count").textContent = json.count;

        alert("Đã xoá khỏi giỏ hàng!");
    });
});
