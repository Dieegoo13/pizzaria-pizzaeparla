let basePrice = 0;
let cart = [];

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalPizza");

    modal.addEventListener("show.bs.modal", (event) => {
        const button = event.relatedTarget;

        basePrice = Number(button.dataset.price) || 0;

        document.getElementById("summaryPizza").innerText =
            button.dataset.pizzaName || "Pizza";

        document.getElementById("summaryBorder").innerText = "—";
        document.getElementById("summaryBeverage").innerText = "—";

        document
            .querySelectorAll(".border-radio")
            .forEach((r) => (r.checked = false));
        document.querySelector(".beverage-select").value = "";

        document.getElementById("modalPizzaId").value = button.dataset.pizzaId;
        document.getElementById("modalSizeId").value = button.dataset.sizeId;

        updateTotal();
    });

    document.querySelectorAll(".border-radio").forEach((radio) => {
        radio.addEventListener("change", () => {
            document.getElementById("summaryBorder").innerText =
                radio.dataset.name;
            updateTotal();
        });
    });

    document
        .querySelector(".beverage-select")
        .addEventListener("change", (e) => {
            const option = e.target.selectedOptions[0];
            document.getElementById("summaryBeverage").innerText =
                option?.dataset.name ?? "—";
            updateTotal();
        });

    document.getElementById("addToCartBtn").addEventListener("click", () => {
        const border = document.querySelector(".border-radio:checked");
        if (!border) {
            alert("Escolha uma borda");
            return;
        }

        const beverageOption = document.querySelector(
            ".beverage-select option:checked",
        );

        cart.push({
            pizza: document.getElementById("summaryPizza").innerText,
            border: border.dataset.name,
            beverage: beverageOption?.dataset.name ?? null,
            total: document.getElementById("summaryTotal").innerText,
        });

        updateCartBadge();
        updateCartDropdown();

        // ✅ FECHA A MODAL CORRETAMENTE
        const modalElement = document.getElementById("modalPizza");
        const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
        modalInstance.hide();
    });
});

function updateTotal() {
    let sum = basePrice;

    const border = document.querySelector(".border-radio:checked");
    if (border) sum += Number(border.dataset.price);

    const beverage = document.querySelector(".beverage-select option:checked");
    if (beverage) sum += Number(beverage.dataset.price);

    document.getElementById("summaryTotal").innerText = sum
        .toFixed(2)
        .replace(".", ",");
}

function updateCartBadge() {
    const badge = document.getElementById("cartBadge");
    badge.innerText = cart.length;
    badge.classList.remove("d-none");
}

function updateCartDropdown() {
    const container = document.getElementById("cartDropdownItems");

    if (cart.length === 0) {
        container.innerHTML =
            '<p class="text-muted small mb-0">Carrinho vazio</p>';
        return;
    }

    container.innerHTML = cart
        .map(
            (item) => `
        <div class="mb-2 border-bottom pb-1">
            <strong>${item.pizza}</strong><br>
            <small>Borda: ${item.border}</small><br>
            ${item.beverage ? `<small>Bebida: ${item.beverage}</small><br>` : ""}
            <span class="text-success fw-bold">R$ ${item.total}</span>
        </div>
    `,
        )
        .join("");
}

updateCartBadge();
updateCartDropdown();
