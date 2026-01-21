<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 11/24/2018
 * Time: 7:18 PM
 */
header('Content-Type: text/javascript');

require_once('db_constants.php');
require_once('page_constants.php');
?>

var PRODUCT_COLOR_NAME_FIELD = '<?php echo PRODUCT_COLOR_NAME_FIELD; ?>';
var PRODUCT_SIZE_DESCRIPTION_FIELD = '<?php echo PRODUCT_SIZE_DESCRIPTION_FIELD; ?>';
var PRODUCT_ITEM_PRICE_FIELD = '<?php echo PRODUCT_ITEM_PRICE_FIELD; ?>';
var PRODUCT_ITEM_ID_FIELD = '<?php echo PRODUCT_ITEM_ID_FIELD; ?>';
var PRODUCT_ITEM_IMAGE_ID = '<?php echo PRODUCT_ITEM_IMAGE_ID; ?>';
var PRODUCT_GROUP_CODE_FIELD = '<?php echo PRODUCT_GROUP_CODE_FIELD ?>';
var PRODUCT_CATEGORY_NAME_FIELD = '<?php echo PRODUCT_CATEGORY_NAME_FIELD ?>';
var PRODUCT_SUBCATEGORY_NAME_FIELD = '<?php echo PRODUCT_SUBCATEGORY_NAME_FIELD ?>';
var PRODUCT_GROUP_DESCRIPTION_FIELD = '<?php echo PRODUCT_GROUP_DESCRIPTION_FIELD ?>';
var HEADER_LINKS_CLASS = '<?php echo HEADER_LINKS_CLASS; ?>';
var CART_COUNT_DISPLAY_ID = '<?php echo CART_COUNT_DISPLAY_ID; ?>';
var SUBTOTAL_DISPLAY_CLASS = '<?php echo SUBTOTAL_DISPLAY_CLASS; ?>'
var TOTAL_DISPLAY_ID = '<?php echo TOTAL_DISPLAY_ID; ?>';
var IMAGE_FOLDER = '<?php echo IMAGE_FOLDER?>';
var QUANTITY_FIELD = '<?php echo QUANTITY_FIELD; ?>';
var SUBTOTAL_FIELD = '<?php echo SUBTOTAL_FIELD; ?>';
var TOTAL_FIELD = '<?php echo TOTAL_FIELD; ?>';
var ITEM_DETAILS_DIV = '<?php echo ITEM_DETAILS_DIV; ?>';
var ITEM_OPTIONS_DIV = '<?php echo ITEM_OPTIONS_DIV; ?>';
var PRICE_DISPLAY_CLASS = '<?php echo PRICE_DISPLAY_CLASS; ?>';
var SIZE_DIV_ID = '<?php echo SIZE_DIV_ID; ?>';
var COLOR_DIV_ID = '<?php echo COLOR_DIV_ID; ?>';
var QUANTITY_DIV_ID = '<?php echo QUANTITY_DIV_ID ?>';
var COLOR_THUMBNAILS_WRAPPER_ID = '<?php echo COLOR_THUMBNAILS_WRAPPER_ID ?>';
var COLOR_THUMBNAIL_CLASS = '<?php echo COLOR_THUMBNAIL_CLASS ?>';
var PRODUCT_ITEMS_PAGE = '<?php echo PRODUCT_ITEMS_PAGE ?>';

var COLOR_DEFAULT_OPTION = 'Select a Color...';
var SIZE_DEFAULT_OPTION = 'Select a Size...';
var COLOR_DROP_DOWN_ID = 'color_drop_down';
var SIZE_DROP_DOWN_ID = 'size_drop_down';
var DROP_DOWN_WRAPPER_DIV_ID = 'drop_down_wrapper';
var DROP_DOWN_OPTIONS_DIV_ID = 'drop_down_options';
var PRODUCT_ITEM_SECTION_ID = 'product_item';
var RESET_BUTTON_ID = 'reset_button';
var COLOR_THUMBNAILS_DIV_ID = 'color_thumbnails';
var COLOR_THUMBNAILS_FOLDER = 'Color Thumbnails/';
var PRICE_P_TAG_ID = 'price';
var ADD_TO_CART_BUTTON_ID = 'add_to_cart';
var QUANTITY_MIN = 1;
var QUANTITY_MAX = 50;
var QUANTITY_DROP_DOWN_ID = 'quantity_drop_down';

var currentColorSelection = '';
var currentSizeSelection = '';
var currentPrice;
var inRange = false;
var outOfRange = false;

function init() {
    const path = window.location.pathname;

    if (path.includes(PRODUCT_ITEMS_PAGE)) {
        initializeProductItemsPage();
    }

    setAriaExpanded();
}

function initializeProductItemsPage() {
    let colorSet = createSet(PRODUCT_COLOR_NAME_FIELD);
    let sizeSet = createSet(PRODUCT_SIZE_DESCRIPTION_FIELD);

    showPrice("", "", true)
    createOuterDropDownDiv();

    if (document.getElementById(QUANTITY_DROP_DOWN_ID) === null) {
        createQuantityDropDown();
    }
    createAddToCartButton();

    if (colorSet.size <= 1 && sizeSet.size <= 1) {
        showPrice(colorSet.values().next().value, sizeSet.values().next().value);
    }

    if (sizeSet.size > 1) {
        createDropDown(sizeSet, SIZE_DEFAULT_OPTION, SIZE_DROP_DOWN_ID);
    }

    if (colorSet.size > 1) {
        createDropDown(colorSet, COLOR_DEFAULT_OPTION, COLOR_DROP_DOWN_ID);
        createColorThumbnailsWrapper();
        showColorThumbnails(colorSet);
    }

    if (colorSet.size === 1) {
        currentColorSelection = colorSet.values().next().value;
    }

    if (sizeSet.size === 1) {
        currentSizeSelection = sizeSet.values().next().value;
    }

    if (document.getElementById(COLOR_DROP_DOWN_ID) === null && document.getElementById(SIZE_DROP_DOWN_ID) === null) {
        showAddToCartButton();
    } 
}

// functions for product_items.php

function createSet(property) {
    let dropDownItems = new Set();

    productItems.forEach(function (item){
        dropDownItems.add(item[property]);
    });
    console.log(dropDownItems);
    return dropDownItems;
}

function createColorThumbnailsWrapper() {
    let colorThumbnailsWrapper = document.createElement("div");
    let colorThumbnailsDiv = document.createElement("div");
    let optionsDiv = document.getElementById(ITEM_OPTIONS_DIV);

    colorThumbnailsDiv.id = COLOR_THUMBNAILS_DIV_ID;
    colorThumbnailsWrapper.id = COLOR_THUMBNAILS_WRAPPER_ID;

    colorThumbnailsWrapper.appendChild(colorThumbnailsDiv);
    optionsDiv.insertBefore(colorThumbnailsWrapper, optionsDiv.childNodes[0]);
}

function showColorThumbnails(colorSet) {
    let image;
    let colorThumbnailsDiv = document.getElementById(COLOR_THUMBNAILS_DIV_ID);

    colorThumbnailsDiv.innerHTML = "";
    colorSet.forEach(function(color) {
        image = document.createElement("img");
        image.className = COLOR_THUMBNAIL_CLASS;
        image.src = IMAGE_FOLDER + category + '/' + subcategory + ' ' + COLOR_THUMBNAILS_FOLDER + groupCode + '-tn-' +
            color.replace(/\s+/g, '-').toLowerCase() + '.jpg';
        image.addEventListener("click", function() {
            let colorDropDown = document.getElementById(COLOR_DROP_DOWN_ID);
            let options = colorDropDown.options;

            for (let count = 0; count < options.length; count++) {
                if (options[count].value === color) {
                    options[count].selected = true;
                    onDropDownItemSelected(COLOR_DROP_DOWN_ID);
                }
            }
        });
        colorThumbnailsDiv.appendChild(image);
    });
}

function createOuterDropDownDiv() {
    let dropDownOptionsDiv = document.createElement("div");
    dropDownOptionsDiv.id = DROP_DOWN_OPTIONS_DIV_ID;
    document.getElementById(DROP_DOWN_WRAPPER_DIV_ID).appendChild(dropDownOptionsDiv);
}

function createDropDown(dropDownSet, defaultOption, id) {
    let dropDownOptionsDiv = document.getElementById(DROP_DOWN_OPTIONS_DIV_ID);
    let innerDiv = document.createElement("div");
    let dropDownLabel = document.createElement("label");
    let html = "";

    html = '<select id="' + id + '">';
    html += '<option value="' + "" + '">' + defaultOption + '</option>';
    dropDownSet.forEach(function (option) {
        html += '<option value="' + option.replace(/"+/g, '&quot') + '">' + option + '</option>';
    });
    html += '</select>';
    innerDiv.innerHTML = html;
    if (id === COLOR_DROP_DOWN_ID) {
        dropDownLabel.innerHTML = "Color: <span class=\"required\">*</span>";
        innerDiv.id = COLOR_DIV_ID;
    }
    if (id === SIZE_DROP_DOWN_ID) {
        dropDownLabel.innerHTML = "Size: <span class=\"required\">*</span>";
        innerDiv.id = SIZE_DIV_ID;
    }
    dropDownLabel.htmlFor = id;
    dropDownOptionsDiv.insertBefore(innerDiv, dropDownOptionsDiv.childNodes[0]);
    innerDiv.insertBefore(dropDownLabel, innerDiv.childNodes[0]);
    document.getElementById(id).onchange = function () {
        if (findSelectedOption(id) === "") {
            hideAddToCartButton();
            return;
        }

        onDropDownItemSelected(id);
    };
}

function onDropDownItemSelected(id) {
    let sizeDropDown = document.getElementById(SIZE_DROP_DOWN_ID);
    let colorDropDown = document.getElementById(COLOR_DROP_DOWN_ID);
    let selectedColor = "";
    let selectedSize = "";
    let defaultColor = "";
    let defaultSize = "";

    if (sizeDropDown && colorDropDown) {
        filterDropDownSet(id);
    }

    if (colorDropDown !== null) {
        selectedColor = findSelectedOption(COLOR_DROP_DOWN_ID);
        defaultColor = colorDropDown.options[1].value;
    }

    if (sizeDropDown !== null) {
        selectedSize = findSelectedOption(SIZE_DROP_DOWN_ID);
        defaultSize = sizeDropDown.options[1].value;
    }

    // The following if statements handle conditions in which only one of the two drop boxes exist
    if (colorDropDown !== null && sizeDropDown === null) {
        changeImage(selectedColor, currentSizeSelection);
        showPrice(selectedColor, currentSizeSelection);
        showAddToCartButton();
    }

    if (colorDropDown === null && sizeDropDown !== null) {
        changeImage(selectedColor, selectedSize);
        showPrice(selectedColor, selectedSize);
        showAddToCartButton();
    }

    // The following if statment and the nested statements within it handle conditions in which only both of the
    // drop downs exist, but a selection has been made from either one of them or both of them.
    if (sizeDropDown && colorDropDown) {

        // Color has been selected but not size
        if (selectedColor !== "" && selectedSize === "") {
            changeImage(selectedColor, defaultSize);
            showPrice(selectedColor, defaultSize, true);
            hideAddToCartButton();
        }

        // Size has been selected but not color
        if (selectedColor === "" && selectedSize !== "") {
            changeImage(defaultColor, selectedSize);
            showPrice(defaultColor, selectedSize, true);
            hideAddToCartButton();
        }

        // Both size and color have been selected
        if (selectedColor !== "" && selectedSize !== "") {
            changeImage(selectedColor, selectedSize);
            showPrice(selectedColor, selectedSize);
            showAddToCartButton();
        }

        if (document.getElementById(RESET_BUTTON_ID) === null) {
            createResetButton();
        }

        showResetButton();
    }
}

function createResetButton() {
    let resetButton = document.createElement('input');
    let dropDownOptionsDiv = document.getElementById(DROP_DOWN_OPTIONS_DIV_ID);

    resetButton.id = RESET_BUTTON_ID;
    resetButton.value = "Reset";
    resetButton.type = "button";
    dropDownOptionsDiv.insertBefore(resetButton, dropDownOptionsDiv.childNodes[2]);
    resetButton.onclick = function() {
        hideAddToCartButton();
        hideResetButton();
        document.getElementById(COLOR_DIV_ID).remove();
        document.getElementById(SIZE_DIV_ID).remove();
        document.getElementById(COLOR_THUMBNAILS_DIV_ID).remove();
        document.getElementById(COLOR_THUMBNAILS_WRAPPER_ID).remove();
        currentColorSelection = '';
        currentSizeSelection = '';

        init();
    };
}

function findSelectedOption(id) {
    let dropDown = document.getElementById(id);
    let selected = dropDown.options[dropDown.selectedIndex].value;

    if (id === COLOR_DROP_DOWN_ID) {
        currentColorSelection = selected;
    }
    if (id === SIZE_DROP_DOWN_ID) {
        currentSizeSelection = selected;
    }
    return selected;
}

function filterDropDownSet(id) {
    let selected = findSelectedOption(id);
    let dropDownSet = new Set();
    let dropDownToChangeID = '';
    let colorDropDown = document.getElementById(COLOR_DROP_DOWN_ID);

    if (selected === '') {
        return;
    }
    productItems.forEach(function(item) {
        if (item[PRODUCT_SIZE_DESCRIPTION_FIELD] === selected && (id === SIZE_DROP_DOWN_ID)) {
            dropDownSet.add(item[PRODUCT_COLOR_NAME_FIELD]);
            dropDownToChangeID = COLOR_DROP_DOWN_ID;
        }
        if (item[PRODUCT_COLOR_NAME_FIELD] === selected && (id === COLOR_DROP_DOWN_ID)) {
            dropDownSet.add(item[PRODUCT_SIZE_DESCRIPTION_FIELD]);
            dropDownToChangeID = SIZE_DROP_DOWN_ID;
        }
    });

    console.log(dropDownSet);

    if (id === SIZE_DROP_DOWN_ID && colorDropDown !== null) {
        showColorThumbnails(dropDownSet);
    }
    repopulateWithFilteredSet(dropDownSet, dropDownToChangeID, selected);
}

function repopulateWithFilteredSet(dropDownSet, id, selected) {
    let dropDown = document.getElementById(id);
    let defaultOption;

    if (id === COLOR_DROP_DOWN_ID) {
        defaultOption = COLOR_DEFAULT_OPTION;
    }
    if (id === SIZE_DROP_DOWN_ID) {
        defaultOption = SIZE_DEFAULT_OPTION;
    }

    html = '<option value="' + "" + '">' + defaultOption + '</option>';
    dropDownSet.forEach(function(option) {
        html += '<option value="' + option.replace(/"+/g, '&quot') + '">' + option + '</option>';
    });
    dropDown.innerHTML = html;

    //reselect the item that was previously selected if applicable
    let options = dropDown.options;

    for (let count = 0; count < options.length; count++) {
        if ((options[count].value === currentSizeSelection) && (id === SIZE_DROP_DOWN_ID)) {
            options[count].selected = true;
        }
        if ((options[count].value === currentColorSelection) && (id === COLOR_DROP_DOWN_ID)) {
            options[count].selected = true;
        }
    }
}

function changeImage(color, size){
    let image = document.getElementById(PRODUCT_ITEM_IMAGE_ID);

    if ((size != "") && (size != null) && (color != "") && (color != null)) {
        color += '-';
    }
    if (size !== null) {
        size = size.replace(/\//, '_');
    }

    if (size !== null) {
        image.src = IMAGE_FOLDER + category + '/' + subcategory + '/' + groupCode + '-' +
            color.toLowerCase().replace(/\s+(?=[^()]*(\(|$))/g, '-').replace(/['"#.]+/g, '_') +
            size.toLowerCase().replace(/\s+(?=[^()]*(\(|$))/g, '-').replace(/['"#.]+/g, '_') + '.jpg';
    } else {
        image.src = IMAGE_FOLDER + category + '/' + subcategory + '/' + groupCode + '-' +
            color.toLowerCase().replace(/\s+(?=[^()]*(\(|$))/g, '-').replace(/["#.]+/g, '_') + '.jpg';
    }
}

function showPrice(color, size, first) {
    let price;
    let lowestPrice = parseFloat(productItems[0][PRODUCT_ITEM_PRICE_FIELD]);

    productItems.forEach(function(item) {
        if ((item[PRODUCT_COLOR_NAME_FIELD] === color || item[PRODUCT_COLOR_NAME_FIELD] === null) &&
            (item[PRODUCT_SIZE_DESCRIPTION_FIELD] === size || item[PRODUCT_SIZE_DESCRIPTION_FIELD] === null)) {
            price = item[PRODUCT_ITEM_PRICE_FIELD];
        }
        if (parseFloat(item[PRODUCT_ITEM_PRICE_FIELD]) < lowestPrice) {
            lowestPrice = item[PRODUCT_ITEM_PRICE_FIELD];
        }
    });

    pricePTag = document.getElementById(PRICE_P_TAG_ID);
    if (pricePTag) {
        pricePTag.parentNode.removeChild(pricePTag)
    }
    pricePTag = document.createElement("p");
    priceSpan = document.createElement("span");
    pricePTag.id = PRICE_P_TAG_ID;
    priceSpan.className = PRICE_DISPLAY_CLASS;
    pricePTag.innerText = 'Prices From: ';
    if (first) {
        priceSpan.innerText = '$' + parseFloat(lowestPrice).toFixed(2);
    } else {
        pricePTag.innerText = '';
        priceSpan.innerText = '$' + price;
        currentPrice = price;
    }
    let dropDownWrapper = document.getElementById(DROP_DOWN_WRAPPER_DIV_ID)
    pricePTag.appendChild(priceSpan);
    dropDownWrapper.insertBefore(pricePTag, dropDownWrapper.childNodes[0]);
}

function createAddToCartButton() {
    let addToCartButton = document.createElement("input");

    addToCartButton.type = 'button';
    addToCartButton.id = ADD_TO_CART_BUTTON_ID;
    addToCartButton.value = 'Add To Cart';
    addToCartButton.hidden = true;
    document.getElementById(DROP_DOWN_WRAPPER_DIV_ID).appendChild(addToCartButton);
    addToCartButton.addEventListener("click", function() {
        let itemID;
        let quantity = findSelectedOption(QUANTITY_DROP_DOWN_ID);

        productItems.forEach(function(item) {
            if ((currentColorSelection === item[PRODUCT_COLOR_NAME_FIELD] || item[PRODUCT_COLOR_NAME_FIELD] === null) &&
                (currentSizeSelection === item[PRODUCT_SIZE_DESCRIPTION_FIELD] || item[PRODUCT_SIZE_DESCRIPTION_FIELD] === null)) {
                itemID = item[PRODUCT_ITEM_ID_FIELD];
            }
        });

        let xhttp = new XMLHttpRequest();
        let sendString = PRODUCT_ITEM_ID_FIELD + '=' + encodeURIComponent(itemID) + '&' + PRODUCT_CATEGORY_NAME_FIELD
            + '=' + encodeURIComponent(category) + '&' + PRODUCT_SUBCATEGORY_NAME_FIELD + '=' +
            encodeURIComponent(subcategory) + '&' + PRODUCT_GROUP_CODE_FIELD + '=' + encodeURIComponent(groupCode) +
            '&' + PRODUCT_COLOR_NAME_FIELD + '=' + encodeURIComponent(currentColorSelection) +
            '&' + PRODUCT_SIZE_DESCRIPTION_FIELD + '=' + encodeURIComponent(currentSizeSelection) + '&' +
            PRODUCT_ITEM_PRICE_FIELD + '=' + encodeURIComponent(currentPrice) + '&' + QUANTITY_FIELD + '=' +
            encodeURIComponent(quantity) + '&' + PRODUCT_GROUP_DESCRIPTION_FIELD + '=' + encodeURIComponent(groupDescription);

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                updateCartCountDisplay(QUANTITY_DROP_DOWN_ID, "+");
            } else if (this.readyState == 4 && this.status !== 200) {
                console.error("PHP Error:", this.responseText);
            }
        }
        xhttp.open("POST", "product_items.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(sendString);
    });
}

function updateCartCountDisplay(id, operator) {
    let cartCountDisplay = document.getElementById(CART_COUNT_DISPLAY_ID);
    let quantitySelected = findSelectedOption(id);
    let currentCartCount = cartCountDisplay.innerText.match(/\d+/)[0];
    let newCartCount;
    if (operator === "+") {
        newCartCount = parseInt(currentCartCount) + parseInt(quantitySelected);
    } else {
        newCartCount = parseInt(currentCartCount) - parseInt(quantitySelected)
    }

    cartCountDisplay.innerText = newCartCount;
}

function onRemoveClicked(id, file) {
    let xhttp = new XMLHttpRequest();
    let sendString = "buttonID=" + id;
    let quantityDropDownID = "quantity_product_id_" + id;
    let subtotalValue = parseFloat(document.getElementById("subtotal_product_" + id).children[0].innerText.replace(/\$|,/g, ''));
    let totalValue = parseFloat(document.getElementById(TOTAL_DISPLAY_ID).children[0].innerText.replace(/\$|,/g, ''));

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let idToFind = "product_id_" + id + "_div";
            updateCartCountDisplay(quantityDropDownID, "-");
            document.getElementById(idToFind).remove();
        } else if (this.readyState == 4 && this.status !== 200) {
            console.error("PHP Error:", this.responseText);
        }
    };
    xhttp.open("POST", file, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(sendString);

    updateTotalDisplay(totalValue - subtotalValue);
}

function hideAddToCartButton() {
document.getElementById(ADD_TO_CART_BUTTON_ID).hidden = true;
}

function showAddToCartButton() {
document.getElementById(ADD_TO_CART_BUTTON_ID).hidden = false;
}

function hideResetButton() {
document.getElementById(RESET_BUTTON_ID).hidden = true;
}

function showResetButton() {
document.getElementById(RESET_BUTTON_ID).hidden = false;
}

// quantity drop down on product_item page
function createQuantityDropDown() {
    let quantityDropDown = document.createElement("select");
    let quantityLabel = document.createElement("label");
    let quantityDiv = document.createElement("div");
    let dropDownOptionsDiv = document.getElementById(DROP_DOWN_OPTIONS_DIV_ID);
    let option;

    quantityDropDown.id = QUANTITY_DROP_DOWN_ID;
    quantityDiv.id = QUANTITY_DIV_ID;
    quantityLabel.innerHTML = "Quantity: <span class=\"required\">*</span>";
    quantityLabel.htmlFor = QUANTITY_DROP_DOWN_ID;
    dropDownOptionsDiv.appendChild(quantityDiv);
    quantityDiv.appendChild(quantityLabel);
    quantityDiv.appendChild(quantityDropDown);
    for (let count = QUANTITY_MIN ; count <= QUANTITY_MAX; count++) {
        option = document.createElement("option");
        option.value = count;
        option.text = count;
        quantityDropDown.appendChild(option);
    }
}

// quantity drop down on shopping_cart page
function onCartPageQuantityChanged(dropDownID, itemID) {
    let selected = findSelectedOption(dropDownID);
    let xhttp = new XMLHttpRequest();
    let sendString = "quantity=" + selected + "&idOfItemChanged=" + itemID;

    xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
           let response = JSON.parse(this.responseText);
           let subtotal = response[SUBTOTAL_FIELD];
           let total = response[TOTAL_FIELD];
           let cartCountDisplay = document.getElementById(CART_COUNT_DISPLAY_ID);
           let currentCartCount = cartCountDisplay.innerText.match(/\d+/)[0];
           let previousQuantity = response[QUANTITY_FIELD];
           let difference = parseInt(previousQuantity) - parseInt(selected);

           cartCountDisplay.innerText = parseInt(currentCartCount) - difference;
           updateSubtotalDisplay(subtotal, itemID);
           updateTotalDisplay(total);
       } else if (this.readyState == 4 && this.status !== 200) {
           console.error("PHP Error:", this.responseText);
       }
    };
    xhttp.open("POST", "shopping_cart.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(sendString);

}

function updateSubtotalDisplay(subtotal, itemID) {
    document.getElementById("subtotal_product_" + itemID).children[0].innerText = "$" + parseFloat(Math.round(subtotal * 100) / 100).toFixed(2);
}

function updateTotalDisplay(total) {
    document.getElementById(TOTAL_DISPLAY_ID).children[0].innerText = "$" + parseFloat(Math.round(total * 100) / 100).toFixed(2);
}


// functions for every page

function setAriaExpanded() {
    console.log("test");
    document.querySelectorAll(".expand_btn").forEach(button => { 
        button.addEventListener("click", () => {
            const isExpanded = button.ariaExpanded === "true";
            button.ariaExpanded = (!isExpanded).toString();
        })
    });
}