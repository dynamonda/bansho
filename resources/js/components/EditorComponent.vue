<template>
    <div>
        <div id="editorjs"></div>
    </div>
</template>

<script>
    import EditorJS from "@editorjs/editorjs";
    
    export default {
        name: "NoteForm",
        data: () => ({
            editor: {},
        }),
        mounted(){
            this.editor = new EditorJS({
                holder: 'editorjs',
            });
        },
        methods: {}
    }
</script>
