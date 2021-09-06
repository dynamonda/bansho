<template>
    <p>NoteListComponent</p>
</template>

<script>
    export default {
        props: {
            user_id: {
                type: Number
            }
        },
        mounted: function() {
            this.init();
        },
        methods: {
            init: async function() {
                this.get_note();
                console.log('表示完了');
            },
            get_note: async function() {
                const self = this;
                axios.get('/note/vue/list/' + self.user_id)
                .then((res) => {
                    console.log("受信成功 user_id=" + self.user_id);
                    console.dir(res.data);
                    /*
                    editor.isReady.then(()=>
                    {
                        // タイトルをセット
                        self.title = res.data.note.title;

                        // 本文をセット
                        var data = res.data.body;
                        if(data === null){
                            editor.clear();
                            return;
                        }

                        console.dir(data);
                        editor.render(data);

                        console.log("初期化完了");
                    });
                    */
                }).catch(err => {
                    console.error("受信エラー: " + err);
                });
            },
        }
    }
</script>