<template>
    <div class="card">
        <div class="card-header">
            <div class="btn-group float-end">
                <button class="btn" v-on:click="save">保存</button>
            </div>
        </div>
        <div class="card-body">
            <div id="editorjs"></div>
        </div>
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
        methods: {
            save(){
                this.editor.save().then((data) => {
                    console.log('保存: ' + data);
                }).catch((err) => {
                    console.error(err);
                });
            }
        }
    }
</script>
