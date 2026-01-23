// ============================================
// PIZZA&PARLA - JAVASCRIPT ORGANIZADO
// ============================================

// ============================================
// 1. VARIÁVEIS GLOBAIS
// ============================================
let basePrice = 0;
let cart = [];

// ============================================
// 2. UTILITÁRIOS - MÁSCARAS DE INPUT
// ============================================
const InputMasks = {
    // Máscara de CEP (00000-000)
    cep(input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\D/g, "");
            if (value.length > 5) {
                value = value.slice(0, 5) + "-" + value.slice(5, 8);
            }
            e.target.value = value;
        });
    },

    // Máscara de CPF (000.000.000-00)
    cpf(input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\D/g, "");
            value = value.replace(
                /(\d{3})(\d{3})(\d{3})(\d{2})/,
                "$1.$2.$3-$4",
            );
            e.target.value = value;
        });
    },

    // Máscara de Telefone ((00) 00000-0000)
    phone(input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\D/g, "");
            if (value.length > 10) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
            } else {
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
            }
            e.target.value = value;
        });
    },

    // Máscara de Cartão de Crédito (0000 0000 0000 0000)
    creditCard(input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\D/g, "");
            value = value.replace(/(\d{4})(?=\d)/g, "$1 ");
            e.target.value = value.trim();
        });
    },

    // Máscara de Validade (MM/AA)
    cardValidity(input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\D/g, "");
            if (value.length > 2) {
                value = value.slice(0, 2) + "/" + value.slice(2, 4);
            }
            e.target.value = value;
        });
    },

    // Apenas números (CVV)
    numbersOnly(input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/\D/g, "");
        });
    },

    // Aplicar todas as máscaras automaticamente
    applyAll() {
        // CEP
        document.querySelectorAll('input[name="cep"]').forEach((input) => {
            this.cep(input);
        });

        // CPF
        document.querySelectorAll('input[name="cpf"]').forEach((input) => {
            this.cpf(input);
        });

        // Telefone
        document.querySelectorAll('input[name="phone"]').forEach((input) => {
            this.phone(input);
        });

        // Cartão de Crédito
        document
            .querySelectorAll('input[name="numero"], #cardNumber')
            .forEach((input) => {
                this.creditCard(input);
            });

        // Validade do Cartão
        document
            .querySelectorAll('input[name="validade"], #cardValidity')
            .forEach((input) => {
                this.cardValidity(input);
            });

        // CVV (apenas números)
        document
            .querySelectorAll('input[name="cvv"], #cardCvv')
            .forEach((input) => {
                this.numbersOnly(input);
            });
    },
};

// ============================================
// 3. MODAL DE PIZZA - PERSONALIZAÇÃO
// ============================================
const PizzaModal = {
    init() {
        const modal = document.getElementById("modalPizza");
        if (!modal) return;

        // Evento ao abrir o modal
        modal.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            this.loadPizzaData(button);
            this.resetSelections();
        });

        // Eventos de mudança
        this.setupBorderRadios();
        this.setupBeverageSelect();
        this.setupAddToCartButton();
    },

    loadPizzaData(button) {
        basePrice = Number(button.dataset.price) || 0;

        document.getElementById("summaryPizza").innerText =
            button.dataset.pizzaName || "Pizza";

        document.getElementById("modalPizzaId").value = button.dataset.pizzaId;
        document.getElementById("modalSizeId").value = button.dataset.sizeId;

        this.updateTotal();
    },

    resetSelections() {
        document.getElementById("summaryBorder").innerText = "—";
        document.getElementById("summaryBeverage").innerText = "—";

        document
            .querySelectorAll(".border-radio")
            .forEach((r) => (r.checked = false));

        const beverageSelect = document.querySelector(".beverage-select");
        if (beverageSelect) beverageSelect.value = "";
    },

    setupBorderRadios() {
        document.querySelectorAll(".border-radio").forEach((radio) => {
            radio.addEventListener("change", () => {
                document.getElementById("summaryBorder").innerText =
                    radio.dataset.name;
                this.updateTotal();
            });
        });
    },

    setupBeverageSelect() {
        const beverageSelect = document.querySelector(".beverage-select");
        if (!beverageSelect) return;

        beverageSelect.addEventListener("change", (e) => {
            const option = e.target.selectedOptions[0];
            document.getElementById("summaryBeverage").innerText =
                option?.dataset.name ?? "—";
            this.updateTotal();
        });
    },

    setupAddToCartButton() {
        const addButton = document.getElementById("addToCartBtn");
        if (!addButton) return;

        addButton.addEventListener("click", () => {
            this.addToCart();
            location.reload();
        });
    },

    updateTotal() {
        let sum = basePrice;

        const border = document.querySelector(".border-radio:checked");
        if (border) sum += Number(border.dataset.price);

        const beverage = document.querySelector(
            ".beverage-select option:checked",
        );
        if (beverage) sum += Number(beverage.dataset.price);

        document.getElementById("summaryTotal").innerText = sum
            .toFixed(2)
            .replace(".", ",");
    },

    addToCart() {
        const data = {
            pizza: document.getElementById("summaryPizza").innerText,
            border: document.getElementById("summaryBorder").innerText,
            beverage: document.getElementById("summaryBeverage").innerText,
            price: parseFloat(
                document
                    .getElementById("summaryTotal")
                    .innerText.replace(",", "."),
            ),
            _token: document.querySelector('meta[name="csrf-token"]').content,
        };

        fetch("/cart/add", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data),
        })
            .then((res) => res.json())
            .then((response) => {
                // Atualiza badge do carrinho
                const cartCount = document.getElementById("cartCount");
                if (cartCount) cartCount.innerText = response.count;

                // Fecha modal
                const modalInstance = bootstrap.Modal.getInstance(
                    document.getElementById("modalPizza"),
                );
                if (modalInstance) modalInstance.hide();
            })
            .catch((error) =>
                console.error("Erro ao adicionar ao carrinho:", error),
            );
    },
};

// ============================================
// 4. CARRINHO - GERENCIAMENTO
// ============================================
const Cart = {
    updateBadge() {
        const badge = document.getElementById("cartBadge");
        if (!badge) return;

        badge.innerText = cart.length;
        badge.classList.remove("d-none");
    },

    updateDropdown() {
        const container = document.getElementById("cartDropdownItems");
        if (!container) return;

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
    },

    removeItem(id) {
        fetch("/cart/remove", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
            body: JSON.stringify({ id }),
        })
            .then(() => location.reload())
            .catch((error) => console.error("Erro ao remover item:", error));
    },

    clear() {
        fetch("/cart/clear", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
        })
            .then(() => location.reload())
            .catch((error) => console.error("Erro ao limpar carrinho:", error));
    },
};

// ============================================
// 5. CHECKOUT - FORMAS DE PAGAMENTO
// ============================================
const Checkout = {
    init() {
        this.setupPaymentOptions();
    },

    setupPaymentOptions() {
        const paymentOptions = document.querySelectorAll(".payment-option");
        const paymentMethodInput = document.getElementById("paymentMethod");

        if (!paymentOptions.length) return;

        const creditCardFields = document.getElementById("creditCardFields");
        const pixMessage = document.getElementById("pixMessage");
        const cashFields = document.getElementById("cashFields");

        const cardNumber = document.getElementById("cardNumber");
        const cardValidity = document.getElementById("cardValidity");
        const cardCvv = document.getElementById("cardCvv");
        const cardName = document.getElementById("cardName");
        const cardCpf = document.getElementById("cardCpf");

        paymentOptions.forEach((btn) => {
            btn.addEventListener("click", function () {
                // Remove active de todos
                paymentOptions.forEach((b) => b.classList.remove("active"));

                // Adiciona active no clicado
                this.classList.add("active");

                // Define método de pagamento
                const method = this.dataset.payment;
                if (paymentMethodInput) paymentMethodInput.value = method;

                // Esconde todos os campos
                if (creditCardFields) creditCardFields.classList.add("d-none");
                if (pixMessage) pixMessage.classList.add("d-none");
                if (cashFields) cashFields.classList.add("d-none");

                // Remove required dos campos de cartão
                [cardNumber, cardValidity, cardCvv, cardName, cardCpf].forEach(
                    (field) => {
                        if (field) field.removeAttribute("required");
                    },
                );

                // Mostra campos específicos do método
                if (method === "credit_card" && creditCardFields) {
                    creditCardFields.classList.remove("d-none");
                    [
                        cardNumber,
                        cardValidity,
                        cardCvv,
                        cardName,
                        cardCpf,
                    ].forEach((field) => {
                        if (field) field.setAttribute("required", "required");
                    });
                } else if (method === "pix" && pixMessage) {
                    pixMessage.classList.remove("d-none");
                } else if (method === "cash" && cashFields) {
                    cashFields.classList.remove("d-none");
                }
            });
        });
    },
};

// ============================================
// 6. PERFIL - GERENCIAMENTO DE DADOS
// ============================================
const Profile = {
    deleteAddress(id) {
        if (!confirm("Deseja realmente remover este endereço?")) return;

        fetch(`/enderecos/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                Accept: "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Erro ao remover endereço");
                }
            })
            .catch((error) => console.error("Erro:", error));
    },

    deleteCard(id) {
        if (!confirm("Deseja realmente remover este cartão?")) return;

        fetch(`/cartoes/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                Accept: "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Erro ao remover cartão");
                }
            })
            .catch((error) => console.error("Erro:", error));
    },
};

// ============================================
// 7. FUNÇÕES GLOBAIS (Mantidas para compatibilidade)
// ============================================
function updateTotal() {
    PizzaModal.updateTotal();
}

function updateCartBadge() {
    Cart.updateBadge();
}

function updateCartDropdown() {
    Cart.updateDropdown();
}

function removeItem(id) {
    Cart.removeItem(id);
}

function clearCart() {
    Cart.clear();
}

function deleteAddress(id) {
    Profile.deleteAddress(id);
}

function deleteCard(id) {
    Profile.deleteCard(id);
}

// ============================================
// 8. INICIALIZAÇÃO GERAL
// ============================================
document.addEventListener("DOMContentLoaded", function () {
    console.log("🍕 Pizza&Parla - Sistema Inicializado");

    // Aplicar máscaras em todos os inputs
    InputMasks.applyAll();

    // Inicializar módulos
    PizzaModal.init();
    Checkout.init();

    // Atualizar carrinho (se existir)
    Cart.updateBadge();
    Cart.updateDropdown();

    console.log("✅ Todos os módulos carregados com sucesso");
});
