<template>
    <div class="row mb-5">
        <div class="col-sm-12">
            <div
                id="carouselExampleIndicators"
                class="carousel slide"
                data-bs-ride="carousel"
            >
                <div class="carousel-indicators">
                    <template
                        v-for="(slider, index) in sliders.original.data"
                        :key="index"
                    >
                        <button
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            :data-bs-slide-to="index"
                            :class="index === 0 ? 'active' : ''"
                            :aria-current="index === 0 ? 'true' : 'false'"
                            :aria-label="`Slide ${index + 1}`"
                        ></button>
                    </template>

                </div>
                <div class="carousel-inner">
                    <template
                        v-for="(slider, index) in sliders.original.data"
                        :key="index"
                    >
                        <div
                            class="carousel-item"
                            :class="index === 0 ? 'active' : ''"
                        >
                            <img
                                :src="`${slider.image}`"
                                class="d-block w-100"
                                alt="..."
                            />
                        </div>
                    </template>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev"
                >
                    <span
                        class="carousel-control-prev-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next"
                >
                    <span
                        class="carousel-control-next-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
//importing bootstrap 5
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import * as Bootstrap from "bootstrap";
//import DemoComponent from "./components/DemoComponent.vue"

export default {
    props: {
        sliders: Object,
    },
    created() {
        console.log("slider", this.sliders);
    },
    mounted() {
        try {
            var myCarousel = document.querySelector(
                "#carouselExampleIndicators"
            );
            if (myCarousel) {
                new Bootstrap.Carousel(myCarousel);
            } else {
                console.error("Carousel element not found");
            }
        } catch (error) {
            console.error("Error initializing carousel:", error);
        }
    },
};
</script>
<style>
/* .carousel-control-prev-icon {
    border: 3px solid rgba(1, 216, 231, 0.61);
    background-color: rgba(37, 6, 110, 0.473);
    padding: 20px;
    border-radius: 50%;
}
.carousel-control-next-icon {
    border: 3px solid rgba(1, 216, 231, 0.61);
    background-color: rgba(37, 6, 110, 0.473);
    padding: 20px;
    border-radius: 50%;
} */
</style>
