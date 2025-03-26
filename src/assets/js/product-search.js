const category = document.getElementById("category");
const theme = document.getElementById("theme");
const difficulty = document.getElementById("difficulty");
const players = document.getElementById("players");
const age = document.getElementById("age");
const playtime = document.getElementById("playtime");

const maxPrice = document.getElementById("max_price");
document.getElementById("value").innerHTML = `${maxPrice.value} €`;
maxPrice.addEventListener("input", function () {
  document.getElementById("value").innerHTML = `${this.value} €`;
});

const filter = document.getElementById("submit-filters");
filter.addEventListener("click", function () {
  //   let submitCategory = category.value;
  //   let submitTheme = theme.value;
  //   let submitDifficulty = difficulty.value;
  //   let submitPlayers = players.value;
  //   let submitAge = age.value;
  //   let submitPlaytime = playtime.value;
  //   let submitMaxPrice = maxPrice.value;

  let select = document.querySelectorAll("select");
  console.log(select);
  let selected = [];
  for (let i = 0; i < selected.length; i++) {
    selected.push(select[i].value);
  }
  console.log(selected);
});

// window.location.href = `products-search.html?category=${submitCategory}&theme=${submitTheme}&difficulty=${submitDifficulty}&players=${submitPlayers}&age=${submitAge}&playtime=${submitPlaytime}`;


// handling empty filters
document.getElementById('filtersForm').addEventListener('submit', function(e) {
  const form = this;
  const inputs = form.getElementsByTagName('input');
  const selects = form.getElementsByTagName('select');
  
  for (let i = 0; i < inputs.length; i++) {
      if (inputs[i].value === inputs[i].min) {
          form.delete(inputs[i].name);  // Supprime le paramètre si vide
      }
  }

  for (let i = 0; i < selects.length; i++) {
    if (selects[i].value === "" || selects[i].value === null) {
      form.delete(selects[i].name);
    }
  }
});