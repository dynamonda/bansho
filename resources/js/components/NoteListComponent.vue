<template>
    <div>
        <p>NoteListComponent</p>
         <div class="row justify-content-end">
            <button type="button" class="btn btn-primary col-2" v-on:click="add_note">新規作成</button>
        </div>
        <div ref="note_list">
            <div class="spinner-border">
            </div>
        </div>
    </div>
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
            init: async function(){
                // 更新
                await this.get_note();
                console.log('表示完了');
            },
            update_list: async function() {
                // Spinnerに変更
                const note_list = this.$refs.note_list;
                note_list.innerHTML = '<div class="spinner-border"></div>';

                // 更新
                await this.get_note();
                console.log('表示完了');
            },
            get_note: async function() {
                const self = this;
                axios.get('/note/vue/list/' + self.user_id)
                .then((res) => {
                    console.log("受信成功 user_id=" + self.user_id);
                    console.dir(res.data);

                    // 更新内容を作成
                    const datas = res.data.map(element => Object.create({id: element.id, title: element.title}));
                    console.log("datas print");
                    console.dir(datas);

                    var html = '<div class="row">';

                    // リスト
                    html += '<div class="list-group col-10">';
                    datas.forEach(function(data){
                        html += '<a href="note/' + data.id + '" class="list-group-item list-group-item-action">' + data.title + '</a>';
                    });
                    html += '</div>';

                    // 削除ボタン
                    html += '<div class="list-group col">';
                    datas.forEach(function(data){
                        html += '<button type="button" class="list-group-item list-group-item-action">' + '削除</button>';
                    })
                    html += '</div>';

                    html += '</div>';

                    // 変更
                    const note_list = self.$refs.note_list;
                    note_list.innerHTML = html;

                }).catch(err => {
                    console.error("受信エラー: " + err);
                });
            },
            add_note: function (event) {
                console.log("追加");
                axios.post('/note/vue/create')
                .then((res) => {
                    console.log("受信成功");
                    console.dir(res);

                    // 更新
                    this.update_list();

                }).catch(err => {
                    console.error("受信エラー: " + err);
                });
            },
            delete_note: function (event) {
                console.log("削除");
            }
        }
    }
</script>