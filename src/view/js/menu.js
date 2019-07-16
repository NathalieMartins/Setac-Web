/**
 * @description Troca a visibilidade do item
 * @param {string} item_id - O id do item
 */
function switch_visibility(item_id) {
  let dropdown = document.getElementById(item_id);

  if(dropdown.classList.contains("is-hidden")) {
    dropdown.classList.remove("is-hidden");
  }
  else if (dropdown.classList.contains("is-hidden-mobile")) {
    dropdown.classList.remove("is-hidden-mobile");
  }
  else {
    dropdown.classList.add("is-hidden");
  }
}