document.addEventListener("DOMContentLoaded", function () {
    let productPrices = document.querySelectorAll(".product-price");

    productPrices.forEach(price => {
        let basePrice = parseFloat(price.dataset.base);
        let demandFactor = Math.random() * (1.2 - 0.8) + 0.8;
        let newPrice = (basePrice * demandFactor).toFixed(2);
        price.innerText = `$${newPrice}`;
    });
});
