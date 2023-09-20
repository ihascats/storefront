let categoriesListContainer = document.getElementById("categoriesDropdown");
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

        // Insert the new category label before the "New Category" input and button
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
    if (specName.value === "" || specDesc.value === "") return;

    // Create a new list item
    let newItem = document.createElement("li");
    newItem.className = "flex items-end gap-2";

    // Create a label for 'name'
    let nameLabel = document.createElement("label");
    nameLabel.className = "flex flex-col tracking-wider w-full text-sm";
    nameLabel.textContent = "name";

    // Create an input field for 'name'
    let nameInput = document.createElement("input");
    nameInput.className =
        "bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7";
    nameInput.name = "specifications[][name]"; // Set the name attribute
    nameInput.value = specName.value;
    // Append the input field to the 'name' label
    nameLabel.appendChild(nameInput);

    // Create a label for 'description'
    let descLabel = document.createElement("label");
    descLabel.className = "flex flex-col tracking-wider w-full text-sm";
    descLabel.textContent = "description";

    // Create an input field for 'description'
    let descInput = document.createElement("input");
    descInput.className =
        "bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7";
    descInput.name = "specifications[][description]"; // Set the name attribute
    descInput.value = specDesc.value;
    // Append the input field to the 'description' label
    descLabel.appendChild(descInput);

    // Append the 'name' label, 'description' label, and 'add' button to the list item
    newItem.appendChild(nameLabel);
    newItem.appendChild(descLabel);

    // Create a "Delete" button for the variant
    let deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.type = "button";
    deleteButton.className = "h-7 px-4 bg-red-600 text-white rounded-md";

    // Attach a click event listener to the delete button
    deleteButton.addEventListener("click", function () {
        // Remove the variant element (newItem) when the delete button is clicked
        specListContainer.removeChild(newItem);
    });

    // Append the delete button to the list item
    newItem.appendChild(deleteButton);

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
let variantPrice = document.getElementById("price");
let variantCurrency = document.getElementById("currency-select");
let variantDiscount = document.getElementById("discount");
let variantStartDate = document.getElementById("start_date");
let variantEndDate = document.getElementById("end_date");

function addVariant() {
    // Create the Price label and elements
    const priceLabel = document.createElement("label");
    priceLabel.classList.add("flex", "flex-col", "tracking-wider");
    priceLabel.textContent = "Price";

    const priceDiv = document.createElement("div");
    priceDiv.classList.add("flex");

    const priceInput = document.createElement("input");
    priceInput.type = "number";
    priceInput.classList.add(
        "bg-white/10",
        "border-l-0",
        "border-r-0",
        "border-t-0",
        "border-b-2",
        "ml-2",
        "h-9",
        "w-36"
    );
    priceInput.name = "variants[][price]";
    priceInput.step = "0.01";
    priceInput.value = variantPrice.value;

    const currencySelect = document.createElement("select");
    currencySelect.name = "variants[][currency]";
    currencySelect.classList.add(
        "bg-white/10",
        "border-l-0",
        "border-r-0",
        "border-t-0",
        "border-b-2",
        "ml-2",
        "h-9",
        "text-xs"
    );

    const currencyOption1 = document.createElement("option");
    currencyOption1.value = "RSD";
    currencyOption1.textContent = "RSD (Serbian Dinar)";
    currencyOption1.classList.add("bg-slate-600");

    const currencyOption2 = document.createElement("option");
    currencyOption2.value = "EUR";
    currencyOption2.textContent = "EUR (Euro)";
    currencyOption2.classList.add("bg-slate-600");

    const currencyOption3 = document.createElement("option");
    currencyOption3.value = "USD";
    currencyOption3.textContent = "USD (US Dollar)";
    currencyOption3.classList.add("bg-slate-600");

    currencySelect.appendChild(currencyOption1);
    currencySelect.appendChild(currencyOption2);
    currencySelect.appendChild(currencyOption3);
    currencySelect.value = variantCurrency.value;

    // Create the Discount label and elements
    const discountLabel = document.createElement("label");
    discountLabel.classList.add("tracking-wider");
    discountLabel.textContent = "Discount";

    const discountUl = document.createElement("ul");
    discountUl.classList.add("flex", "gap-2", "pl-2");

    const discountDiv = document.createElement("div");
    discountDiv.classList.add("flex", "gap-2");

    const discountAmountLabel = document.createElement("label");
    discountAmountLabel.classList.add(
        "flex",
        "flex-col",
        "tracking-wider",
        "text-sm",
        "pl-2"
    );
    discountAmountLabel.textContent = "amount";

    const discountAmountInput = document.createElement("input");
    discountAmountInput.type = "number";
    discountAmountInput.value = "0";
    discountAmountInput.min = "0";
    discountAmountInput.max = "100";
    discountAmountInput.classList.add(
        "bg-white/10",
        "border-l-0",
        "border-r-0",
        "border-t-0",
        "border-b-2",
        "h-7",
        "w-20"
    );
    discountAmountInput.name = "variants[][discount]";
    discountAmountInput.value = variantDiscount.value;

    const discountPercentageSpan = document.createElement("span");
    discountPercentageSpan.textContent = "%";
    discountPercentageSpan.classList.add("text-3xl");

    const discountArrowSpan = document.createElement("span");
    discountArrowSpan.textContent = "->";
    discountArrowSpan.classList.add("text-lg", "mt-1");

    const discountedPriceSpan = document.createElement("span");
    discountedPriceSpan.textContent = "Discounted Price: 0";
    discountedPriceSpan.classList.add("text-lg", "mt-1");

    discountDiv.appendChild(discountAmountInput);
    discountDiv.appendChild(discountPercentageSpan);
    discountDiv.appendChild(discountArrowSpan);
    discountDiv.appendChild(discountedPriceSpan);
    discountAmountLabel.appendChild(discountDiv);
    discountUl.appendChild(discountAmountLabel);

    function calculateDiscountedPrice() {
        const discountPercentage = parseFloat(discountAmountInput.value);
        const originalPrice = parseFloat(priceInput.value);

        if (!isNaN(discountPercentage) && !isNaN(originalPrice)) {
            const discountedPrice =
                originalPrice - originalPrice * (discountPercentage / 100);
            discountedPriceSpan.textContent = `Discounted Price: ${discountedPrice.toFixed(
                2
            )} ${currencySelect.value}`;
        } else {
            discountedPriceSpan.textContent = "Discounted Price: 0";
        }
    }
    discountAmountInput.addEventListener("input", calculateDiscountedPrice);
    priceInput.addEventListener("input", calculateDiscountedPrice);
    currencySelect.addEventListener("change", calculateDiscountedPrice);
    calculateDiscountedPrice();

    const dateUl = document.createElement("ul");
    dateUl.classList.add("flex", "gap-2", "pl-2");

    // Create the start date and end date elements
    const startDateLabel = document.createElement("label");
    startDateLabel.classList.add(
        "flex",
        "flex-col",
        "tracking-wider",
        "text-sm"
    );
    startDateLabel.textContent = "start date";

    const startDateInput = document.createElement("input");
    startDateInput.type = "datetime-local";
    startDateInput.classList.add(
        "bg-white/10",
        "border-l-0",
        "border-r-0",
        "border-t-0",
        "border-b-2",
        "h-7"
    );
    startDateInput.name = "variants[][discount_start_date]";
    startDateInput.value = variantStartDate.value;

    const endDateLabel = document.createElement("label");
    endDateLabel.classList.add("flex", "flex-col", "tracking-wider", "text-sm");
    endDateLabel.textContent = "end date";

    const endDateInput = document.createElement("input");
    endDateInput.type = "datetime-local";
    endDateInput.classList.add(
        "bg-white/10",
        "border-l-0",
        "border-r-0",
        "border-t-0",
        "border-b-2",
        "h-7"
    );
    endDateInput.name = "variants[][discount_exp_date]";
    endDateInput.value = variantEndDate.value;

    const discountDurationSpan = document.createElement("span");
    discountDurationSpan.textContent = "Discount Duration: N/A";
    discountDurationSpan.classList.add("text-lg", "mt-5");

    // Append all elements to the document
    priceDiv.appendChild(priceInput);
    priceDiv.appendChild(currencySelect);
    priceLabel.appendChild(priceDiv);

    startDateLabel.appendChild(startDateInput);
    endDateLabel.appendChild(endDateInput);
    dateUl.appendChild(startDateLabel);
    dateUl.appendChild(endDateLabel);
    dateUl.appendChild(discountDurationSpan);

    discountLabel.appendChild(discountAmountLabel);
    discountLabel.appendChild(dateUl);

    function calculateDuration() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (!isNaN(startDate) && !isNaN(endDate) && startDate <= endDate) {
            const durationMilliseconds = endDate - startDate;
            const days = Math.floor(
                durationMilliseconds / (1000 * 60 * 60 * 24)
            );
            const hours = Math.floor(
                (durationMilliseconds % (1000 * 60 * 60 * 24)) /
                    (1000 * 60 * 60)
            );
            const minutes = Math.floor(
                (durationMilliseconds % (1000 * 60 * 60)) / (1000 * 60)
            );
            const seconds = Math.floor(
                (durationMilliseconds % (1000 * 60)) / 1000
            );

            discountDurationSpan.textContent = `Discount Duration: ${days}d, ${hours}h, ${minutes}m, ${seconds}s`;
        } else {
            discountDurationSpan.textContent = "Discount Duration: Invalid";
        }
    }
    // Add an event listener to the start date input
    startDateInput.addEventListener("input", () => {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        // Check if the start date is after the end date
        if (startDate > endDate) {
            alert("Start date cannot be after end date");
            startDateInput.value = endDateInput.value; // Clear the input field
        }
        calculateDuration();
    });

    // Add an event listener to the end date input
    endDateInput.addEventListener("input", () => {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        // Check if the end date is before the start date
        if (endDate < startDate) {
            alert("End date cannot be before start date");
            endDateInput.value = startDateInput.value; // Clear the input field
        }
        calculateDuration();
    });
    calculateDuration();

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

    if (!selectedColor || !selectedSize || variantQuantity.value === "") return;

    // Create a new list item
    let newItem = document.createElement("li");
    newItem.className = "flex flex-col tracking-wider pl-2 bg-white/10";

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
    newItem.appendChild(priceLabel);
    newItem.appendChild(discountLabel);

    const variantDiv = document.createElement("div");
    variantDiv.classList.add("flex", "gap-2");

    variantDiv.appendChild(colorLabel);
    variantDiv.appendChild(sizesLabel);
    variantDiv.appendChild(quantityLabel);
    newItem.appendChild(variantDiv);

    // Create a "Delete" button for the variant
    let deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.type = "button";
    deleteButton.className = "ml-2 h-7 px-4 bg-red-600 text-white rounded-md";

    // Attach a click event listener to the delete button
    deleteButton.addEventListener("click", function () {
        // Remove the variant element (newItem) when the delete button is clicked
        variantListContainer.removeChild(newItem);
    });

    // Append the delete button to the list item
    newItem.appendChild(deleteButton);

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
