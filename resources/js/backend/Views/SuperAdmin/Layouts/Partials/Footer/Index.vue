<template>
    <div class="right-sidebar" :class="rightToggle ? 'right-toggled' : ''">
        <div class="switcher-icon" @click="rightToggle = !rightToggle">
            <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
        </div>
        <div class="right-sidebar-content">
            <p class="mb-0">Gaussion Texture</p>
            <hr />

            <ul class="switcher">
                <li id="theme1" @click="changeTheme('1')"></li>
                <li id="theme2" @click="changeTheme('2')"></li>
                <li id="theme3" @click="changeTheme('3')"></li>
                <li id="theme4" @click="changeTheme('4')"></li>
                <li id="theme5" @click="changeTheme('5')"></li>
                <li id="theme6" @click="changeTheme('6')"></li>
            </ul>

            <p class="mb-0">Gradient Background</p>
            <hr />

            <ul class="switcher">
                <li id="theme7" @click="changeTheme('7')"></li>
                <li id="theme8" @click="changeTheme('8')"></li>
                <li id="theme9" @click="changeTheme('9')"></li>
                <li id="theme10" @click="changeTheme('10')"></li>
                <li id="theme11" @click="changeTheme('11')"></li>
                <li id="theme12" @click="changeTheme('12')"></li>
                <li id="theme13" @click="changeTheme('13')"></li>
                <li id="theme14" @click="changeTheme('14')"></li>
                <li id="theme15" @click="changeTheme('15')"></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        rightToggle: false,
    }),
    created() {
        if (localStorage.getItem("theme_id")) {
            this.changeTheme(localStorage.getItem("theme_id"));
        }
    },
    methods: {
        changeTheme(id) {
            localStorage.setItem("theme_id", id);
            const totalThemes = Array.from({ length: 15 }, (_, i) => i + 1);
            const newThemeNo = "bg-theme" + id;
            const body = document.getElementById("body");


            totalThemes.forEach((item) => {
                const currentThemeClass = "bg-theme" + item;
                if (body.classList.contains(currentThemeClass)) {
                    body.classList.remove(currentThemeClass);
                }
            });

            body.classList.add(newThemeNo);
        },
    },
};
</script>

<style></style>
