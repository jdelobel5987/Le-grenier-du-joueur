const container = document.querySelector(".container");
const basketContainer = document.querySelector(".basket-container");
const basket = document.querySelectorAll(".basket-unit");
const prices = document.querySelectorAll(".basket-unit span");

let totalPrice = 0;

function empty() {
  container.innerHTML = "";
  container.insertAdjacentHTML(
    "afterbegin",
    `<div class="empty-basket">
        <h2>Votre panier est vide <i class="fa-solid fa-face-sad-tear"></i></h2><br>
        <p><i class="fa-solid fa-magnifying-glass fa-2x"></i>  Explorez nos merveilleux produits </p>
        <p>&nbsp&nbsp&nbsp ou venez nous-rendre visite&nbsp&nbsp<i class="fa-solid fa-dungeon fa-2x"></i></p>
    </div>`
  );
}

function buttonUpdate() {
  const button = document.querySelector(".btn");
  if (totalPrice == 0) {
    button.disabled = true;
    button.style.opacity = 0.5;
    button.textContent = "Aucun article sélectionné";
  } else {
    button.disabled = false;
    button.style.opacity = 1;
    button.textContent = "Valider mon panier";
  }
}

if (!basketContainer.children.length) {
  empty();
}

if (prices.lenght != 0) {
  prices.forEach((price) => {
    totalPrice += parseFloat(price.textContent);
  });
  document.querySelector("#total").textContent = `Total : ${totalPrice} €`;
  buttonUpdate();
}

basket.forEach((basketUnit) => {
  const checkbox = basketUnit.querySelector("input");
  const value = basketUnit.querySelector("span");
  const price = parseFloat(value.textContent);
  const remove = basketUnit.querySelector("i");
  const product = basketUnit.querySelector("label").textContent;

  checkbox.addEventListener("change", () => {
    if (checkbox.checked != true) {
      basketUnit.style.opacity = 0.5;
      totalPrice -= price;
      document.querySelector("#total").textContent = `${totalPrice} €`;
      console.log(`${product} déselectionné, montant total mis à jour`);
      buttonUpdate();
    } else {
      basketUnit.style.opacity = 1;
      totalPrice += price;
      document.querySelector("#total").textContent = `${totalPrice} €`;
      console.log(`${product} sélectionné, montant total mis à jour`);
      buttonUpdate();
    }
  });

  remove.addEventListener("click", () => {
    let confirmSupp = confirm(
      `Êtes-vous sur de vouloir supprimer ${product} de votre panier?`
    );
    if (confirmSupp) {
      basketUnit.parentNode.removeChild(basketUnit);
      if (checkbox.checked == true) {
        totalPrice -= price;
        document.querySelector("#total").textContent = `${totalPrice} €`;
      }
      alert(`${product} a bien été supprimé du panier`);
      console.log(
        `suppression de ${product} du panier validée par l'utilisateur.
        Montant total mis à jour: ${totalPrice} €`
      );
    }
    if (!basketContainer.children.length) {
      empty();
    }
  });
});
