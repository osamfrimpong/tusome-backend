document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("category");
    const subcategorySelect = document.getElementById("subcategory");

    categorySelect.addEventListener("change", function () {
        const categoryId = this.value;

        fetch(`/api/categories/${categoryId}/subcategories`)
            .then((response) => response.json())
            .then((data) => {
                subcategorySelect.innerHTML =
                    '<option value="">Select Subcategory</option>';
                data.forEach((subcategory) => {
                    subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                });
            })
            .catch((error) =>
                console.error("Error fetching subcategories:", error)
            );
    });
});
