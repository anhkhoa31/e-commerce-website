// function create_element(tag_name, content) {
//   const element = document.createElement(tag_name);
//   const text = document.createTextNode(content);
//   element.appendChild(text);
//   return element;
// }

function reset_cart() {
  localStorage.removeItem("orders");
  let cart = document.getElementById("cart_body");
  cart.innerHTML = `
    <tr>
      <th scope='row'>Total price</th>
      <td >0</td>
    </tr>
  `;
}

function render_shopping_cart() {
  let cart_body = document.getElementById("cart_body");
  cart_body.innerHTML = ``;
  let products = JSON.parse(localStorage.getItem("orders"));
  let total_order_price = 0;
  for (let i = 0; i < products.length; i++) {
    let p_id = products[i].p_id;
    let p_vendor = products[i].p_vendor;
    let p_name = products[i].p_name;
    let p_price = products[i].p_price;
    let p_description = products[i].p_description;
    let p_created_time = products[i].p_created_time;
    let p_quantity = products[i].p_quantity;
    let total_price = p_price * p_quantity;
    //The price of the whole order
    total_order_price += total_price;
    cart_body.innerHTML += `
      <tr>
        <th scope='row'>${p_id}</th>
        <td class='vendor'>${p_vendor}</td>
        <td class='name'>${p_name}</td>
        <td class='price'>${p_price}</td>
        <td class='description'>${p_description}</td>
        <td class='created_time'>${p_created_time}</td>
        <td class='quantity'>${p_quantity}</td>
        <td class='total'>${total_price}</td>
        <td>
            <button class='nav_btn' onClick='remove_product(this)' data-id='${p_id}'>Remove</button>
        </td>
    </tr>
    `;
  }
  cart_body.innerHTML += `
    <tr>
      <th scope='row'>Total price</th>
      <td >${total_order_price}</td>
    </tr>
  `;
}

function add_product(product) {
  if (localStorage.getItem("orders") == null) {
    localStorage.setItem("orders", "[]");
  }
  let is_duplicated = 0;
  let cart = JSON.parse(localStorage.getItem("orders"));
  for (let i = 0; i < cart.length; i++) {
    if (product.p_id == cart[i].p_id) {
      is_duplicated = 1;
      cart[i].p_quantity++;
    }
  }
  if (is_duplicated == 0) {
    product.p_quantity = 1;
    cart.push(product);
  }
  console.log(cart);
  localStorage.setItem("orders", JSON.stringify(cart));
  render_shopping_cart();
}

function remove_product(obj) {
  let id = obj.dataset.id;
  if (localStorage.getItem("orders") == null) {
    localStorage.setItem("orders", "[]");
  } else {
    let cart = JSON.parse(localStorage.getItem("orders"));
    cart = cart.filter(product => product.p_id != id);
    localStorage.setItem("orders", JSON.stringify(cart));
    render_shopping_cart();
  }
}

function reply_click(obj) {
  let id = obj.dataset.id;
  let vendor = document.querySelector(`.${id} .vendor`).textContent;
  let name = document.querySelector(`.${id} .name`).textContent;
  let price = document.querySelector(`.${id} .price`).textContent;
  let description = document.querySelector(
    `.${id} .description`
  ).textContent;
  let created_time = document.querySelector(
    `.${id} .created_time`
  ).textContent;
  let product = {
    p_id: id,
    p_vendor: vendor,
    p_name: name,
    p_price: price,
    p_description: description,
    p_created_time: created_time,
  };
  add_product(product);
}

function order() {
  let order = localStorage.getItem("orders");
  document.getElementById('order_value').value = order;
  // alert(document.getElementById('order_value').value);
  localStorage.removeItem("orders");
  render_shopping_cart();
}

render_shopping_cart();
