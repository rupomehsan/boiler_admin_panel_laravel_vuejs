<template>
    
    <nav aria-label="Page navigation example" class="">
        <ul class="pagination my-2">
            <template v-for="(link, index) in data.links" :key="index">
                <li class="page-item" :class="{ active: link.active }">
                    <a class="page-link" :class="data.current_page == data.last_page &&
                            data.links.length - 1 == index
                            ? 'disabled'
                            : ''
                        " @click.prevent="() => (link.url ? method(link.url) : '')
        " :href="link.url" v-html="`<span>${link.label}</span>`">
                    </a>
                </li>
            </template>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        data: Object,
        method: Function,
    },
};
</script>

<style></style>
