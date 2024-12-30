const basket = document.querySelectorAll(".basket-unit");
const prices = document.querySelectorAll(".basket-unit span");
console.log(prices);

let totalPrice = 0;
if (prices.length != 0) {
  prices.forEach((price) => {
    totalPrice += parseFloat(price.textContent);
  });
  document.querySelector("#total").textContent = `${totalPrice} €`;
}

basket.forEach((basketUnit) => {
  const checkbox = basketUnit.querySelector("input");
  const value = basketUnit.querySelector("span");
  const price = parseFloat(value.textContent);
  const remove = basketUnit.querySelector("i");

  checkbox.addEventListener("change", () => {
    if (checkbox.checked != true) {
      basketUnit.style.opacity = 0.5;
      totalPrice -= price;
      document.querySelector("#total").textContent = `${totalPrice} €`;
      console.log("article déselectionné, total H.T. mis à jour");
    } else {
      basketUnit.style.opacity = 1;
      totalPrice += price;
      document.querySelector("#total").textContent = `${totalPrice} €`;
      console.log("article sélectionné, total H.T. mis à jour");
    }
  });

  remove.addEventListener("click", () => {
    let confirmSupp = confirm(
      "Êtes-vous sur de vouloir supprimer cet article ?"
    );
    if (confirmSupp) {
      basketUnit.parentNode.removeChild(basketUnit);
      alert("L'article a bien été supprimé");
      console.log("suppression d'un article du panier");
    }
  });
});
