
/* ==========================================
   DELETE ITEMS
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteModal = document.getElementById("deleteModal");
    const confirmDelete = document.getElementById("confirmDelete");
    const cancelDelete = document.getElementById("cancelDelete");

    deleteButtons.forEach(button => {

        button.addEventListener("click", function (event) {

            event.preventDefault();

            const itemID = this.dataset.id;

            confirmDelete.href =
                "../admin/processes/deleteItemProcess.php?id=" + itemID;

            // Show modal
            deleteModal.classList.add("show");

        });

    });

    // Hide when Cancel is clicked
    cancelDelete.addEventListener("click", function () {

        deleteModal.classList.remove("show");

    });

});