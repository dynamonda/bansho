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

            this.get_note();
        },
        methods: {
            get_note: async function() {
                axios.get('/note/vue/' + this.note_id)
                .then((res) => {
                    //this.tasks = res.data;
                    console.log("受信成功");
                    console.dir(res);
                }).catch(err => {
                    console.error("受信エラー");
                });
            },
            save: async function () {
                const sendurl = 'app/save/' + this.note_id;
                console.log("SendUrl=" + sendurl);

                const contentData = await this.editor.save();
                console.log(contentData);

                // POST送信
                axios.post(sendurl, {
                    data: contentData
                }).then(() => {
                    // レスポンスが200の時の処理
                    console.log("送れたよ")
                }).catch(err => {
                    if(err.response) {
                        // レスポンスが200以外の時の処理
                        console.log("送信エラーだよ. " + err.name);
                    }
                });
            }
        }
    }
</script>
