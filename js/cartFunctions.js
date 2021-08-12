//Oblicza całkowitą kwotę koszyka oraz wyświetla ją
function calculateTotalPriceGame(id) {
    let gp = parseFloat(document.getElementsByClassName('game-price-hidden')[id].value).toFixed(2);
    let gq = parseInt(document.getElementsByClassName('game-quantity')[id].value);
    let gtp = document.getElementsByClassName('game-cart-price')[id];

            
    gtp.innerHTML = parseFloat(gp * gq).toFixed(2) + " zł";
}

//Oblicza kwotę danego produktu w koszyku oraz wyświetla ją
function calculateTotalPrice() {
    let elements = document.getElementsByClassName('game-quantity');
    let tp = document.getElementById('total-price');
    var totalPrice = 0 ;
    for (let i = 0; i < elements.length; i++) {
        totalPrice += parseFloat(document.getElementsByClassName('game-price-hidden')[i].value).toFixed(2) * parseInt(document.getElementsByClassName('game-quantity')[i].value);
    }
    tp.innerHTML = parseFloat(totalPrice).toFixed(2) + " zł";
}

//Wywołuję funkcję calculateTotalPrice() podczas ładowania strony
window.onload = calculateTotalPrice();