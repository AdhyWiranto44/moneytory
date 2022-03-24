<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content card border-0 shadow">
        <div class="modal-header">
            <h5 class="modal-title fw-bold" id="exampleModalLabel">Keranjang</h5>
            <button type="button" class="float-right btn btn-sm btn-light border-0 rounded-circle shadow-sm" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="cart-modal modal-body">
            Keranjang Kosong!
            {{-- <div class="p-3 mb-3 border-bottom">
                <div class="row">
                    <div class="col-8">
                        <h6 class="fw-bold mb-0">Nama Product</h6>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mt-2 overflow-hidden text-end">Rp {{ number_format(45000, 0, ",", ".") }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="cart-buttons d-flex">
                            <button class="decrease border-0 bg-transparent"><i class="bi bi-dash-circle"></i></button>
                            <h6 class="amount mt-2">0</h6>
                            <button class="increase border-0 bg-transparent"><i class="bi bi-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="remove btn btn-sm btn-light border-0 rounded-circle float-end"><i class="bi bi-x"></i></button>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="modal-footer">
            <form action="/cart/delete" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="return confirm('Yakin hapus keranjang?')">Hapus Keranjang</button>
            </form>
        <button type="button" class="btn btn-salmon fw-bold">Checkout</button>
        </div>
    </div>
    </div>
</div>
<script>
    const cartButton = document.querySelector('.cart-button');
    const cartModal = document.querySelector('.cart-modal');
    let cartCount = document.querySelector('.cart-count');
    const csrf = document.getElementsByName('_token')[0].value;
    let cartRemove = [];
    let cartItems = [];

    cartButton.addEventListener('click', async () => {
        await getCart().then((data) => {
            cartItems = [...data];
        });
        renderCartItems(cartItems);
    });

    const renderCartItems = (product) => {
        clearCartModal();
        let productLists = "";
        const productLength = product.length;
        if (product.length > 0) {
            for (let i = 0; i < product.length; i++) {
                productLists += `
                    <input type="hidden" class="product-stock" value="${product[i].stock}" />
                    <input type="hidden" class="product-code" value="${product[i].code}" />
                    <div class="p-3 mb-3 border-bottom">
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
            cartModal.innerHTML = "Keranjang kosong!";
        }
        cartRemove = document.querySelectorAll('.cart-remove');
        cartRemove.forEach(removeBtn => {
            removeBtn.addEventListener('click', () => {
                const isDelete = confirm('Hapus dari keranjang?');
                if (isDelete) {
                    cartItems = cartItems.filter(item => item.code !== removeBtn.value);
                    decreaseCartCount();
                    renderCartItems(cartItems);
                    removeProductCart(removeBtn.value);
                }
            });
        });

        const decreaseButton = document.querySelectorAll('.decrease');
        const increaseButton = document.querySelectorAll('.increase');
        const productStock = document.querySelectorAll('.product-stock');
        const productCode = document.querySelectorAll('.product-code');
        const productAmount = document.querySelectorAll('.amount');

        decreaseButton.forEach((dec, i) => {
            dec.addEventListener('click', () => {
                if (parseInt(productAmount[i].innerText) > 1) {
                    productAmount[i].innerText--;
                    changeAmount(productCode[i].value, "decrease");
                } else {
                    cartItems = cartItems.filter(item => item.code !== productCode[i].value);
                    decreaseCartCount();
                    renderCartItems(cartItems);
                    removeProductCart(productCode[i].value);
                }
            });
        });

        increaseButton.forEach((inc, i) => {
            inc.addEventListener('click', () => {
                if (parseInt(productAmount[i].innerText) < parseInt(productStock[i].value)) {
                    productAmount[i].innerText++;
                    changeAmount(productCode[i].value, "increase");
                }
            });
        });
    }

    const decreaseCartCount = () => {
        cartCount.innerText = parseInt(cartCount.innerText) - 1;
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