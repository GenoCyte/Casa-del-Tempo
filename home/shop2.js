var carts = document.querySelectorAll('.item_button')

var products = [
    {
        name: "Chicken Breast",
        tag: "ChickenBreast",
        price: 274,
        inCart: 0
    },
    {
        name: "Chicken Drumstick",
        tag: "ChickenDrumstick",
        price: 150,
        inCart: 0
    },
    {
        name: "Chicken Thigh",
        tag: "ChickenThigh",
        price: 192,
        inCart: 0
    },
    {
        name: "Chicken Wing",
        tag: "ChickenWing",
        price: 234,
        inCart: 0
    },
    {
        name: "Whole Chicken",
        tag: "WholeChicken",
        price: 170,
        inCart: 0
    }
]

for(let i=0; i < carts.length; i++){
    carts[i].addEventListener('click', function (){
        cartNumbers(products[i])
        totalCost(products[i])
    })
}

function cartNumbers(products){
    var productNumbers = localStorage.getItem('cartNumbers')
    
    productNumbers = parseInt(productNumbers)
    if(productNumbers){
        localStorage.setItem('cartNumbers', productNumbers + 1)
    }else{
        localStorage.setItem('cartNumbers', 1)
    }
    setItem(products)
}

function setItem(products){
    var cartItems = localStorage.getItem('productsInCart')
    cartItems = JSON.parse(cartItems)

    if(cartItems != null){

        if(cartItems[products.tag] == undefined){
           cartItems = {
                ...cartItems,
                [products.tag]: products
           }
        }
        cartItems[products.tag].inCart += 1
    }else{
        products.inCart = 1
        cartItems = {
            [products.tag]: products
        }
    }

    localStorage.setItem('productsInCart', JSON.stringify(cartItems))
}

function totalCost(products){
    var cartCost = localStorage.getItem('totalCost')

    if(cartCost != null){
        cartCost = parseInt(cartCost)
        localStorage.setItem('totalCost', cartCost + products.price)
    }else{
        localStorage.setItem('totalCost', products.price)
    }
}

function displayCart(){
    var cartItems = localStorage.getItem('productsInCart')
    cartItems = JSON.parse(cartItems)
    productContainer = document.querySelector('.cart_menu')
    var cartCost = localStorage.getItem('totalCost')
    
    if(cartItems && productContainer){
        productContainer.innerHTML = ''
        Object.values(cartItems).map(item => {
            productContainer.innerHTML += `
                <div id="product">
                    <div id="cart_panel_item">
                        <button class="remove_btn" type="button">X</button>
                        <img src="${item.tag}.png">
                    </div>
                    <div id="name">
                        <p>${item.name}</p>
                    </div>
                    <div id="price">
                        <span>₱${item.price}.00</span>
                    </div>
                    <div id="weight">
                        <ion-icon name="remove-circle-outline"></ion-icon>
                        <span>${item.inCart}</span>
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </div>
                    <div id="price">
                        <span>₱${item.inCart * item.price}.00</span>
                    </div>
                </div>
            `
        })
         productContainer.innerHTML += `
            <div id="cart_total">
                <span id="cart_total">Total: ₱${cartCost}.00</span>
            </div>
         `
    }
}

displayCart();