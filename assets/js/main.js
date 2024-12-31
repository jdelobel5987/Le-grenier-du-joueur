const search = document.querySelector(".searchBar>input");
const searchBtn = document.querySelector(".searchBar>button");

document.addEventListener("keydown", (e) => {
  if (e.key == "Enter") {
    let input = search.value;
    console.log(input);
  }
});

searchBtn.addEventListener("click", () => {
  let input = search.value;
  console.log(input);
});
