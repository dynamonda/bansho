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
    var editor;

    export default {
        name: "NoteForm",
        data: function () {
            return {
            };
        },
        computed: {
            editorjs() { return this.editor },
            render(renderData) {
                const self = this;
                self.editor.render(renderData);
            }
        },
        props: {
            note_id: {
                type: Number
            }
        },
        mounted: function(){
            this.init();
        },
        methods: {
            init: async function() {
                editor = new EditorJS({
                    holder: 'editorjs',
                });

                await this.get_note();
            },
            get_note: async function() {
                const self = this;
                axios.get('/note/vue/' + self.note_id)
                .then((res) => {
                    console.log("受信成功 note_id=" + self.note_id);
                    editor.isReady.then(()=>
                    {
                        var data = res.data.body;
                        if(data === null){
                            editor.clear();
                            return;
                        }
                        editor.render(data);
                    });
                }).catch(err => {
                    console.error("受信エラー: " + err);
                });
            },
            save: async function () {
                const sendurl = '/note/vue/' + this.note_id;
                console.log("SendUrl=" + sendurl);

                const contentData = await editor.save();
                console.log(contentData);

                // POST送信
                axios.put(sendurl, {
                    data: contentData
                }, {
                    headers: {
                        'Content-Type': "application/json",
                    }
                }).then( async (result) => {
                    // レスポンスが200の時の処理
                    console.log("送れたよ")
                    console.dir(result);

                    // 更新
                    await this.get_note();
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
