//Oblicza kwotę danego produktu w koszyku oraz wyświetla ją
function calculateTotalPriceGame(id) {
    let gp = parseFloat(document.getElementsByClassName('game-price-hidden')[id].value).toFixed(2);
    let gq = parseInt(document.getElementsByClassName('game-quantity')[id].value);
    let gtp = document.getElementsByClassName('game-cart-price')[id];
    
            
    gtp.innerHTML = parseFloat(gp * gq).toFixed(2) + " zł";
}

//Oblicza całkowitą kwotę koszyka oraz wyświetla ją
function calculateTotalPrice() {
    let elements = document.getElementsByClassName('game-quantity');
    let tp = document.getElementById('total-price');
    let discount = document.getElementById("discount").value;

    var totalPrice = 0 ;
    for (let i = 0; i < elements.length; i++) {
        totalPrice += parseFloat(document.getElementsByClassName('game-price-hidden')[i].value).toFixed(2) * parseInt(document.getElementsByClassName('game-quantity')[i].value);
    }
    let totalValue = parseFloat(totalPrice - discount).toFixed(2);
    if(totalValue >= 0) {
        if(discount > 0)
            tp.innerHTML = totalValue + " zł w tym rabat: " + discount + " zł"; 
        else
            tp.innerHTML = totalValue + " zł";
    }  
    else
        if(discount > 0)
            tp.innerHTML = "0 zł w tym rabat: " + parseFloat(totalPrice).toFixed(2) + " zł";
}

//Wywołuję funkcję calculateTotalPrice() podczas ładowania strony
window.onload = calculateTotalPrice();