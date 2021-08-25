//Liczy cenę netto oraz wyświetla ją
function autoQuantity() {
    const quantityValue = parseInt(document.getElementById('quantity-admin-form').value);
    let keys = document.getElementById('keys-admin-form').value;
    let quantity = document.getElementById('quantity-admin-form');
    let key = keys.split(",");

    if(key.length == 0)
        quantity.value = quantityValue + key.length;
    else
        quantity.value = key.length;
}