let categoriesList = [];
let addCategoryButton = document.getElementById("addCategory");

function addCategory() {
    let newCategoryInput = document.getElementById("new_category");
    let newCategory = newCategoryInput.value.trim();

    if (newCategory !== "") {
        // Create the new category checkbox
        let newCategoryLabel = document.createElement("label");
        newCategoryLabel.textContent = newCategory;

        let newCategoryCheckbox = document.createElement("input");
        newCategoryCheckbox.type = "checkbox";
        newCategoryCheckbox.name = "categories[]";
        newCategoryCheckbox.value = newCategory;
        newCategoryCheckbox.checked = true;

        newCategoryLabel.appendChild(newCategoryCheckbox);

        // Get the container for the categories list
        let categoriesListContainer = document.getElementById("categoriesList");

        // Insert the new category checkbox as the first child of the container
        categoriesListContainer.insertBefore(
            newCategoryLabel,
            categoriesListContainer.firstChild
        );

        // Add the new category to the categoriesList array
        categoriesList.unshift(newCategory);

        // Clear the input field
        newCategoryInput.value = "";
    }
}

addCategoryButton.onclick = addCategory;
