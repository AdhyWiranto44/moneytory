<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content card border-0 shadow">
        <div class="modal-header">
            <h5 class="modal-title fw-bold" id="exampleModalLabel">Keranjang</h5>
            <button type="button" class="float-right btn btn-sm btn-light border-0 rounded-circle shadow-sm" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <div class="cart-modal my-3">
                <p class='text-center'>Keranjang Kosong!</p>
            </div>
            <div class="cart-price">
                <div class="row">
                    <div class="col-md-6">
                        <label for="income-code" class="mb-0">Kode Pemasukan/order</label>
                        <div class="input-group mb-3">
                            <input type="text" class="income-code form-control" id="income-code" name="income-code" placeholder="Kode Pemasukan/Order, mis: INC1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="extra-charge" class="mb-0">Biaya tambahan</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="extra-charge form-control" id="extra-charge" name="extra-charge" placeholder="Biaya tambahan">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold">Sub Total</h6>
                        <h5>Rp <span class="sub-total h5">0</span></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold">Biaya Tambahan</h6>
                        <h5>Rp <span class="extra-charge-2 h5">0</span></h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold">Grand Total</h6>
                        <h5>Rp <span class="grand-total h5">0</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <form action="/cart/delete" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="return confirm('Yakin hapus keranjang?')">Hapus Keranjang</button>
            </form>
        <button type="button" class="checkout-button btn btn-salmon fw-bold">Checkout</button>
        </div>
    </div>
    </div>
</div>
<script>
    const cartButton = document.querySelector('.cart-button');
    const cartModal = document.querySelector('.cart-modal');
    let cartCount = document.querySelector('.cart-count');
    const csrf = document.getElementsByName('_token')[0].value;
    let cartItems = [];
    let subTotalInfo = document.querySelector('.sub-total');
    let grandTotalInfo = document.querySelector('.grand-total');
    let extraChargeInput = document.querySelector('.extra-charge');
    let incomeCodeInput = document.querySelector('.income-code');
    let extraChargeInfo = document.querySelector('.extra-charge-2');
    const checkoutButton = document.querySelector('.checkout-button');
    const modalFooter = document.querySelector('.modal-footer');
    let subTotal = 0, extra = 0, grandTotal = 0;

    checkoutButton.addEventListener('click', () => {
        // persiapkan form yang ingin datanya dikirim
        const products = cartItems.map(item => {
            return item.code
        });
        const amounts = cartItems.map(item => {
            return item.amount 
        });
        const prices = cartItems.map(item => {
            return item.price 
        });
        let formInput = {
            "code": incomeCodeInput.value,
            "extra_charge": parseInt(extraChargeInput.value) || 0,
            "products": products.join(),
            "amounts": amounts.join(),
            "prices": prices.join(),
        }
        
        // kirim datanya ke backend
        checkout(formInput);

        // refresh halaman
        location.reload();
    });

    extraChargeInput.addEventListener('keyup', (e) => {
        let value = e.target.value;
        calculateExtraCharge(value);
        calculateGrandTotal();
    });

    cartButton.addEventListener('click', async () => {
        await getCart().then((data) => {
            cartItems = [...data];
        });
        renderCartItems(cartItems);
    });

    const calculateSubTotal = () => {
        subTotal = 0;
        cartItems.forEach(item => {
            subTotal += (item.price*item.amount);
        });
        subTotalInfo.innerText = subTotal;
    }

    const calculateExtraCharge = (value) => {
        extra = parseInt(value) || 0;
        extraChargeInfo.innerText = extra;
    }

    const calculateGrandTotal = () => {
        grandTotal = subTotal + extra;
        grandTotalInfo.innerText = grandTotal;
    }

    const hideCheckoutButton = () => {
        modalFooter.classList.add('d-none');
    }

    const renderCartItems = (product) => {
        let productLists = "";
        const productLength = product.length;

        clearCartModal();
        
        if (productLength > 0) {
            for (let i = 0; i < productLength; i++) {
                productLists += `
                    <input type="hidden" class="product-stock" value="${product[i].stock}" />
                    <input type="hidden" class="product-code" value="${product[i].code}" />
                    <div class="p-3 mb-3 card">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="fw-bold mb-0">${product[i].name}</h6>
                            </div>
                            <div class="col-md-4">
                                <h6 class="fw-bold mt-2 overflow-hidden text-end">Rp ${product[i].price}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="cart-buttons d-flex">
                                    <button class="decrease border-0 bg-transparent"><i class="bi bi-dash-circle"></i></button>
                                    <h6 class="amount mt-2">${product[i].amount}</h6>
                                    <button class="increase border-0 bg-transparent"><i class="bi bi-plus-circle"></i></button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="cart-remove btn btn-sm btn-light border-0 rounded-circle float-end" value="${product[i].code}"><i class="bi bi-x"></i></button>
                            </div>
                        </div>
                    </div>
                    `;
            }
            cartModal.innerHTML = productLists;
        } else {
            cartModal.innerHTML = "<p class='text-center'>Keranjang kosong!</p>";
            hideCheckoutButton();
        }

        calculateSubTotal();
        calculateGrandTotal();

        const productInCart = {
            "removeButton": document.querySelectorAll('.cart-remove'),
            "decreaseButton": document.querySelectorAll('.decrease'),
            "increaseButton": document.querySelectorAll('.increase'),
            "stock": document.querySelectorAll('.product-stock'), // stok produk di db
            "amount": document.querySelectorAll('.amount'), // jumlah di keranjang
            "code": document.querySelectorAll('.product-code')
        }

        // Menghapus produk pada keranjang
        productInCart.removeButton.forEach(btn => {
            btn.addEventListener('click', () => {
                const isDelete = confirm('Hapus dari keranjang?');
                if (isDelete) {
                    cartItems = cartItems.filter(item => item.code !== btn.value);
                    decreaseCartCount();
                    calculateSubTotal();
                    removeProductCart(btn.value);
                    renderCartItems(cartItems);
                }
            });
        });

        // Mengurangi jumlah item pada keranjang
        productInCart.decreaseButton.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                if (parseInt(productInCart.amount[i].innerText) > 1) {
                    productInCart.amount[i].innerText--;
                    cartItems[i].amount--;
                    changeAmount(productInCart.code[i].value, "decrease");
                } else {
                    cartItems = cartItems.filter(item => item.code !== productInCart.code[i].value);
                    decreaseCartCount();
                    removeProductCart(productInCart.code[i].value);
                    renderCartItems(cartItems);
                }
                calculateSubTotal();
                calculateGrandTotal();
            });
        });

        // Menambahkan jumlah item pada keranjang
        productInCart.increaseButton.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                if (parseInt(productInCart.amount[i].innerText) < parseInt(productInCart.stock[i].value)) {
                    productInCart.amount[i].innerText++;
                    cartItems[i].amount++;
                    changeAmount(productInCart.code[i].value, "increase");
                }
                calculateSubTotal();
                calculateGrandTotal();
            });
        });
    }

    const decreaseCartCount = () => {
        cartCount.innerText = parseInt(cartCount.innerText) - 1;
    }

    const checkout = async function(formInput) {
        const url = '/incomes/add-new';
        const response = await fetch(url, {
            method: 'POST',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ '_token': csrf, ...formInput })
        });
    }

    const changeAmount = async function(productCode, action) {
        const url = '/cart';
        const response = await fetch(`${url}/${productCode}/${action}`, {
            method: 'POST',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ '_method': "PATCH", '_token': csrf })
        });
    }

    const removeProductCart = async function(productCode) {
        const url = '/cart';
        const response = await fetch(`${url}/${productCode}/delete`, {
            method: 'POST',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ '_method': "DELETE", '_token': csrf })
        });
    }

    const clearCartModal = () => {
        cartModal.innerHTML = '';
    }

    const getCart = async function() {
        const url = '/cart';
        const response = await fetch(url, {
            method: 'GET',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        return response.json();
    }
</script>