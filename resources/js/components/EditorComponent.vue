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
        props: {
            note_id: {
                type: Number
            }
        },
        mounted(){
            this.editor = new EditorJS({
                holder: 'editorjs',
            });
        },
        methods: {
            save: async function () {
                const sendurl = 'app/save/' + this.note_id;
                console.log("SendUrl=" + sendurl);

                var contentData = await this.editor.save();
                console.log(contentData);
            }
        }
    }
</script>
