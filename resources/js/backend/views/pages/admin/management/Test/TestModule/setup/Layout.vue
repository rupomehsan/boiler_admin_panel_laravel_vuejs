<template>
    <router-view></router-view>
</template>

<script>
import setup from ".";

let page_title = setup.page_title;
export default {
    data: () => ({
        page_title,
    })
}
</script>

<style></style>
