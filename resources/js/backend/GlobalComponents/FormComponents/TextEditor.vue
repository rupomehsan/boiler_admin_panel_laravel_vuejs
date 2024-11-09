<template>
    {{ name }}
    <div>
        <div :id="name"></div>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            required: true,
            type: String,
        },
    },
    created() {

        this.initialiteSummerNote(this.name)
        this.initialiteSummerNote(this.name)
        this.summerNoteTooltip('Style', 'dropdown-style')
        this.summerNoteTooltip('Font Family', 'dropdown-fontname')
        this.summerNoteTooltip('More Color', 'note-color')
        this.summerNoteTooltip('Paragraph', 'note-color')
        this.summerNoteTooltip('Table', 'note-table')


    },
    methods: {
        initialiteSummerNote(id) {
            setTimeout(function () {
                $(`#${id}`).summernote({
                    height: 216,
                    tabsize: 2,
                });
            }, 1000)
        },
        summerNoteTooltip(style, classname) {
            setTimeout(function () {
                let target = document.querySelector(`[data-bs-original-title="${style}"]`);
                let targetClass = document.querySelector(`.${classname}`);
                target.addEventListener('click', function () {
                    targetClass.classList.toggle('show');
                    if (classname == 'note-color' || classname == 'note-table') {
                        target.nextSibling.classList.toggle('show')
                    }
                });
            }, 1000)
        },
    }
}
</script>

<style>
.popover-content.note-children-container {
    background: gray;
}
</style>
