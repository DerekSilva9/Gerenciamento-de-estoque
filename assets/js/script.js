document.addEventListener("DOMContentLoaded", function () {
    // ===== Modal de Adicionar =====
    const modalAdicionar = document.getElementById("modalAdicionar");
    const openBtnAdicionar = document.getElementById("openModal");
    const closeBtnAdicionar = document.getElementById("closeModal");

    openBtnAdicionar.addEventListener("click", function (e) {
        e.preventDefault();
        modalAdicionar.style.display = "block";
    });

    closeBtnAdicionar.addEventListener("click", function () {
        modalAdicionar.style.display = "none";
    });

    // ===== Modal de Edição =====
    const modalEditar = document.getElementById("modalEditar");
    const closeBtnEditar = document.getElementById("closeModalEditar");
    const editButtons = document.querySelectorAll(".openEditModal");

    editButtons.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            modalEditar.style.display = "block";

            // Preencher os campos com os dados do botão
            document.getElementById("editar-id").value = this.dataset.id;
            document.getElementById("editar-nome").value = this.dataset.nome;
            document.getElementById("editar-descricao").value = this.dataset.descricao;
            document.getElementById("editar-quantidade").value = this.dataset.quantidade;
            document.getElementById("editar-categoria").value = this.dataset.categoria;
            document.getElementById("editar-preco").value = this.dataset.preco;
        });
    });

    closeBtnEditar.addEventListener("click", function () {
        modalEditar.style.display = "none";
    });

    // Fechar ao clicar fora de qualquer modal
    window.addEventListener("click", function (e) {
        if (e.target === modalAdicionar) {
            modalAdicionar.style.display = "none";
        }
        if (e.target === modalEditar) {
            modalEditar.style.display = "none";
        }
    });
});
