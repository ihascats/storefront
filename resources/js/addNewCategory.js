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

let variantListContainer = document.getElementById("variantList");
let addVariantButton = document.getElementById("addVariant");
let variantColor = document.getElementById("variant_color");
let variantQuantity = document.getElementById("variant_quantity");
let variantSizes = document.getElementById("variant_sizes");

function addVariant() {
    // Get the colorsDropdown element
    var colorsDropdown = document.getElementById("colorsDropdown");

    // Get the selected radio button inside the colorsDropdown
    var selectedColor = colorsDropdown.querySelector(
        "input[name='colors[]']:checked"
    );
    // Get the colorsDropdown element
    var sizesDropdown = document.getElementById("sizesDropdown");

    // Get the selected radio button inside the colorsDropdown
    var selectedSize = sizesDropdown.querySelector(
        "input[name='sizes[]']:checked"
    );

    // Create a new list item
    let newItem = document.createElement("li");
    newItem.className = "flex items-end";

    // Create a label for 'color'
    let colorLabel = document.createElement("label");
    colorLabel.className = "flex flex-col tracking-wider w-full";
    colorLabel.textContent = "color";

    // Create an input field for 'color'
    let colorInput = document.createElement("input");
    colorInput.className =
        "bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7";
    colorInput.name = "variants[][color]";
    colorInput.value = selectedColor.value; // Get value from previous field
    // Append the input field to the 'color' label
    colorLabel.appendChild(colorInput);

    // Create a label for 'sizes'
    let sizesLabel = document.createElement("label");
    sizesLabel.className = "flex flex-col tracking-wider w-full";
    sizesLabel.textContent = "sizes";

    // Create an input field for 'sizes'
    let sizesInput = document.createElement("input");
    sizesInput.className =
        "bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7";
    sizesInput.name = "variants[][sizes]";
    sizesInput.value = selectedSize.value; // Get value from previous field
    // Append the input field to the 'sizes' label
    sizesLabel.appendChild(sizesInput);

    // Create a label for 'quantity'
    let quantityLabel = document.createElement("label");
    quantityLabel.className = "flex flex-col tracking-wider w-full";
    quantityLabel.textContent = "quantity";

    // Create an input field for 'quantity'
    let quantityInput = document.createElement("input");
    quantityInput.className =
        "bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7";
    quantityInput.name = "variants[][quantity]";
    quantityInput.value = variantQuantity.value; // Get value from previous field
    // Append the input field to the 'quantity' label
    quantityLabel.appendChild(quantityInput);

    // Append the 'color' label, 'quantity' label, 'sizes' label, and 'add' button to the list item
    newItem.appendChild(colorLabel);
    newItem.appendChild(sizesLabel);
    newItem.appendChild(quantityLabel);

    // Insert the new list item at the end of the list
    variantListContainer.appendChild(newItem);

    // Clear the previous input fields
    selectedColor.checked = false;
    selectedSize.checked = false;
    variantQuantity.value = "";
}

addVariantButton.addEventListener("click", addVariant);

let colorsListContainer = document.getElementById("colorsDropdown");
let addColorButton = document.getElementById("addColor");
let newColorInput = document.getElementById("new_color");

function addColor() {
    let newColor = newColorInput.value.trim();

    if (newColor !== "") {
        // Create a new color label with classes
        let newColorLabel = document.createElement("label");
        newColorLabel.className = "pl-2 relative flex gap-2 items-center";

        // Create a new color checkbox
        let newColorCheckbox = document.createElement("input");
        newColorCheckbox.type = "radio";
        newColorCheckbox.name = "colors[]";
        newColorCheckbox.value = newColor;
        newColorCheckbox.className = "inline float-left";
        newColorCheckbox.checked = true;

        // Append the checkbox to the label
        newColorLabel.appendChild(newColorCheckbox);

        // Create a span for the text
        let labelText = document.createElement("span");
        labelText.textContent = newColor;

        // Append the text span to the label
        newColorLabel.appendChild(labelText);

        // Insert the new color label after the "New Color" input
        colorsListContainer.insertBefore(
            newColorLabel,
            addColorButton.parentElement.nextElementSibling
        );

        // Clear the input field
        newColorInput.value = "";
    }
}

addColorButton.onclick = addColor;

// Repeat the same process for sizes
let sizesListContainer = document.getElementById("sizesDropdown");
let addSizeButton = document.getElementById("addSize");
let newSizeInput = document.getElementById("new_size");

function addSize() {
    let newSize = newSizeInput.value.trim();

    if (newSize !== "") {
        // Create a new size label with classes
        let newSizeLabel = document.createElement("label");
        newSizeLabel.className = "pl-2 relative flex gap-2 items-center";

        // Create a new size checkbox
        let newSizeCheckbox = document.createElement("input");
        newSizeCheckbox.type = "radio";
        newSizeCheckbox.name = "sizes[]";
        newSizeCheckbox.value = newSize;
        newSizeCheckbox.className = "inline float-left";
        newSizeCheckbox.checked = true;

        // Append the checkbox to the label
        newSizeLabel.appendChild(newSizeCheckbox);

        // Create a span for the text
        let labelText = document.createElement("span");
        labelText.textContent = newSize;

        // Append the text span to the label
        newSizeLabel.appendChild(labelText);

        // Insert the new size label after the "New Size" input
        sizesListContainer.insertBefore(
            newSizeLabel,
            addSizeButton.parentElement.nextElementSibling
        );

        // Clear the input field
        newSizeInput.value = "";
    }
}

addSizeButton.onclick = addSize;
