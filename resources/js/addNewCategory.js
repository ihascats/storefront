let categoriesListContainer = document.getElementById("categoriesList");
let addCategoryButton = document.getElementById("addCategory");
let newCategoryInput = document.getElementById("new_category");

function addCategory() {
    let newCategory = newCategoryInput.value.trim();

    if (newCategory !== "") {
        // Create a new category label with classes
        let newCategoryLabel = document.createElement("label");
        newCategoryLabel.className = "pl-2 relative flex gap-2 items-center";

        // Create a new category checkbox
        let newCategoryCheckbox = document.createElement("input");
        newCategoryCheckbox.type = "checkbox";
        newCategoryCheckbox.name = "categories[]";
        newCategoryCheckbox.value = newCategory;
        newCategoryCheckbox.className = "inline float-left";
        newCategoryCheckbox.checked = true;

        // Append the checkbox to the label
        newCategoryLabel.appendChild(newCategoryCheckbox);

        // Create a span for the text
        let labelText = document.createElement("span");
        labelText.textContent = newCategory;

        // Append the text span to the label
        newCategoryLabel.appendChild(labelText);

        // Insert the new category label after the new_category label
        categoriesListContainer.insertBefore(
            newCategoryLabel,
            addCategoryButton.parentElement.nextElementSibling
        );

        // Clear the input field
        newCategoryInput.value = "";
    }
}

addCategoryButton.onclick = addCategory;

let specListContainer = document.getElementById("specList");
let addSpecButton = document.getElementById("addSpec");
let specName = document.getElementById("spec_name");
let specDesc = document.getElementById("spec_desc");
let baseListItem = document.querySelector("#specList > li"); // Get the base list item

function addSpec() {
    // Create a new list item
    let newItem = document.createElement("li");
    newItem.className = "flex items-end";

    // Create a label for 'name'
    let nameLabel = document.createElement("label");
    nameLabel.className = "flex flex-col tracking-wider w-full";
    nameLabel.textContent = "name";

    // Create an input field for 'name'
    let nameInput = document.createElement("input");
    nameInput.className =
        "bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7";
    nameInput.name = "specifications[][name]"; // Set the name attribute
    nameInput.value = specName.value;
    // Append the input field to the 'name' label
    nameLabel.appendChild(nameInput);

    // Create a label for 'description'
    let descLabel = document.createElement("label");
    descLabel.className = "flex flex-col tracking-wider w-full";
    descLabel.textContent = "description";

    // Create an input field for 'description'
    let descInput = document.createElement("input");
    descInput.className =
        "bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7";
    descInput.name = "specifications[][description]"; // Set the name attribute
    descInput.value = specDesc.value;
    // Append the input field to the 'description' label
    descLabel.appendChild(descInput);

    // Append the 'name' label, 'description' label, and 'add' button to the list item
    newItem.appendChild(nameLabel);
    newItem.appendChild(descLabel);

    // Insert the new list item after the base list item
    specListContainer.insertBefore(newItem, baseListItem.nextSibling);

    // Clear the input fields
    specName.value = "";
    specDesc.value = "";
}

addSpecButton.addEventListener("click", addSpec);
