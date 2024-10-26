<template>
    <!-- header start -->
    <header>
        <div class="header-top-area bb d-none d-lg-block pbg">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        <p class="h2-color text-center text-white">
                            Wellcome to Satrany store!
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <div class="header-top-right">
                            <div class="account-menu text-white">
                                <ul>
                                    <!-- <li>
                    <Link href="/profile" class="text-white">My Account</Link>
                  </li> -->

                                    <li>
                                        <Link href="/cart" class="text-white"
                                            >Shopping Cart</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            href="/wishlist"
                                            class="text-white"
                                            >Wishlist</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            href="/compare-list"
                                            class="text-white"
                                            >Compare list</Link
                                        >
                                    </li>
                                    <li>
                                        <Link href="/login" class="text-white"
                                            >Login</Link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-3 col-5">
                        <div class="logo m-0">
                            <Link href="/" class="d-flex align-items-center">
                                <img
                                    src="/frontend/assets/images/logo/logo.png"
                                    alt=""
                                    class="rounded-circle img-fluid my-1"
                                    height="100"
                                    width="100"
                                />
                                <span class="logo-title">Satrani </span>
                            </Link>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div
                            class="home3-mainmenu mainmenu home3-hover dropdown m-0"
                        >
                            <nav>
                                <ul class="menu-list">
                                    <li>
                                        <Link
                                            href="/"
                                            :class="{
                                                'active-link':
                                                    $page.url === '/',
                                            }"
                                            >Home
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url === '/about-us',
                                            }"
                                            href="/about-us"
                                            >About Us</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url ===
                                                    '/terms-and-conditions',
                                            }"
                                            href="/terms-and-conditions"
                                            >Terms & Conditions</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url ===
                                                    '/return-and-refund',
                                            }"
                                            href="/return-and-refund"
                                            >Return & Refund</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url === '/contact-us',
                                            }"
                                            href="/contact-us"
                                            >Contact us</Link
                                        >
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-7 d-lg-none">
                        <div class="header-actions">
                            <div class="top-cart home3-bg ">
                                <div class="cart">
                                    <i class="icofont icofont-bag"></i>
                                    <a href="#" class="">
                                        {{ all_cart_data.length }} Items -
                                        <strong class=""
                                            >{{ total_cart_price }} ৳</strong
                                        >
                                        <i
                                            class="icofont icofont-rounded-down"
                                        ></i>
                                    </a>
                                </div>
                                <ul class="px-3">
                                    <li>
                                        <div class="cart-items">
                                            <div
                                                class="cart-item bb mt-10"
                                                v-for="cart in all_cart_data"
                                            >
                                                <div class="cart-img">
                                                    <a href="#">
                                                        <img
                                                            :src="
                                                                cart.product
                                                                    ?.images
                                                                    .length
                                                                    ? cart
                                                                          .product
                                                                          ?.images[0]
                                                                          .url
                                                                    : 'dummy.png'
                                                            "
                                                            alt=""
                                                        />
                                                    </a>
                                                </div>
                                                <div class="cart-content">
                                                    <a
                                                        :href="`product-details/${cart.product?.slug}`"
                                                        >{{
                                                            cart.product?.title
                                                        }}</a
                                                    >
                                                    <a
                                                        @click="
                                                            removeFromCart(
                                                                cart.id
                                                            )
                                                        "
                                                        class="pull-right cart-remove"
                                                        role="button"
                                                    >
                                                        <i
                                                            class="fa fa-times"
                                                        ></i>
                                                    </a>
                                                    <span
                                                        >{{ cart.quantity }} x
                                                        {{
                                                            cart.product?.current_price
                                                        }}
                                                        =
                                                        {{
                                                            cart.quantity *
                                                            cart.product?.current_price
                                                        }}
                                                        ৳</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="cart-btn my-3 mx-auto">
                                                <a href="cart">view cart</a>
                                                <a href="checkout">Checkout</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <button
                                class="action-toggle d-lg-none"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasMenu"
                            >
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom home3-bg" id="HeaderTopCards">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-2 col-lg-3 d-none d-lg-block">
                        <div class="position-relative">
                            <div
                                class="categories-menu text-uppercase home3-bg2 home3-categories-menu click"
                                @click="is_home = !is_home"
                            >
                                <i class="fa fa-list-ul"></i>
                                <span>All Categories</span>
                            </div>
                            <div
                                class="menu-container home3-menu-container home3-hover toggole"
                                :class="is_home ? 'd-block' : 'd-none'"
                            >
                                <ul>
                                    <li
                                        v-for="category in $page.props
                                            .categories"
                                    >
                                        <a
                                            :href="`products?category=${category.slug}`"
                                        >
                                            <i class="fa fa-star"></i>
                                            {{ category.title }}
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="#">
                                            <i class="fa fa-plus-square-o"></i>
                                            More Categories
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4">
                        <div class="search-box home3-search-box">
                            <form @submit.prevent="searchHandler">
                                <input
                                    type="text"
                                    placeholder="Search Products…"
                                    v-model="search"
                                />
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-2 d-none d-lg-block">
                        <div class="top-cart home3-top-cart home3-bg bg-5">
                            <div class="cart">
                                <i class="icofont icofont-bag"></i>
                                <a href="#" class="mx-2">
                                    {{ all_cart_data.length }} Items -
                                    <strong class="mx-2"
                                        >{{ total_cart_price }} ৳</strong
                                    >
                                    <i class="icofont icofont-rounded-down"></i>
                                </a>
                            </div>
                            <ul class="px-3">
                                <li>
                                    <div class="cart-items">
                                        <div
                                            class="cart-item bb mt-10"
                                            v-for="cart in all_cart_data"
                                        >
                                            <div class="cart-img">
                                                <a href="#">
                                                    <img
                                                        :src="
                                                            cart.product?.images
                                                                .length
                                                                ? cart.product
                                                                      ?.images[0]
                                                                      .url
                                                                : 'dummy.png'
                                                        "
                                                        alt=""
                                                    />
                                                </a>
                                            </div>
                                            <div class="cart-content">
                                                <a
                                                    :href="`product-details/${cart.product?.slug}`"
                                                    >{{
                                                        cart.product?.title
                                                    }}</a
                                                >
                                                <a
                                                    @click="
                                                        removeFromCart(cart.id)
                                                    "
                                                    class="pull-right cart-remove"
                                                    role="button"
                                                >
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                <span
                                                    >{{ cart.quantity }} x
                                                    {{ cart.product?.current_price }}
                                                    =
                                                    {{
                                                        cart.quantity *
                                                        cart.product?.current_price
                                                    }}
                                                    ৳</span
                                                >
                                            </div>
                                        </div>
                                        <div class="cart-btn my-3 mx-auto">
                                            <a href="cart">view cart</a>
                                            <a href="checkout">Checkout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
</template>

<script>
import { mapActions, mapState } from "pinia";
import { common_page_store } from "./Store/index";
export default {
    data: () => ({
        is_home: true,
        search: "",
    }),
    created: async function () {
        try {
            let location = window.location.pathname;
            if (location !== "/") {
                this.is_home = false;
            }
        } catch (error) {
            console.error("Error  created hook:", error);
        }

        await this.get_all_cart_data();
        await this.get_all_categories();
        await this.visitor_count();
    },

    methods: {
        ...mapActions(common_page_store, {
            get_all_cart_data: "get_all_cart_data",
            get_all_categories: "get_all_categories",
            remove_cart_item: "remove_cart_item",
        }),
        removeFromCart: async function (cartId) {
            let response = await this.remove_cart_item(cartId);
            if (response.data.status == "success") {
                window.s_alert(response.data.message);
                await this.get_all_cart_data();
            }
        },
        searchHandler: function () {
            window.location.href = `products?search=${this.search}`;
        },
        visitor_count: async function () {
            let response = await axios.get(`/visitor-count`);
            response = response.data.data;
        },
    },
    computed: {
        ...mapState(common_page_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",
        }),
    },

    // computed: {
    //     all_cart_data() {
    //         return this.$page.props.cartItems?.original?.data;
    //     },
    // },
};
</script>

<style scoped>
@media (max-width: 575.98px) {
    .d-custom-sm-none {
        display: none !important;
    }
    .header-actions {
    margin-top: 0px;
}
}
</style>
