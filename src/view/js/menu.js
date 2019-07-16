function switch_visibility(item_id) {
  let dropdown = document.getElementById(item_id);


  if(dropdown.classList.contains("is-hidden")) {
    dropdown.classList.remove("is-hidden");
  }
  else {
    dropdown.classList.add("is-hidden");
  }
}