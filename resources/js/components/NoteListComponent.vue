<template>
    <div>
        <p>NoteListComponent</p>
         <div class="row justify-content-end">
            <button type="button" class="btn btn-primary col-2" v-on:click="add_note">新規作成</button>
        </div>
        <div v-if="loading">
            <div class="spinner-border"></div>
        </div>
        <div v-if="!loading">
            <div class="row">
                <div class="list-group col-10">
                    <a v-for="note in noteList" v-bind:key="note.id"
                        v-bind:href="'note/' + note.id"
                        class="list-group-item list-group-item-action">{{ note.title }}</a>
                </div>
                <div class="list-group col">
                    <button v-for="note in noteList" v-bind:key="note.id"
                        v-on:click="delete_note(note.id)"
                        class="list-group-item list-group-item-action">削除</button>
                </div>
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
        data: function() {
            return {
                loading: true,
                noteList: []
            };
        },
        mounted: function() {
            this.init();
        },
        methods: {
            init: async function(){
                this.loading = true;
                await this.update_list();
                this.loading = false;
            },
            add_note: function (event) {
                console.log("追加");
                this.loading = true;

                axios.post('/note/vue/create')
                .then((res) => {
                    console.log("受信成功");
                    console.dir(res);

                    // 更新
                    this.update_list();
                    
                    this.loading = false;
                }).catch(err => {
                    console.error("受信エラー: " + err);
                    this.loading = false;
                });
            },
            delete_note: async function (note_id) {
                console.log("削除 note_id=" + note_id);
                // 更新処理
                this.loading = true;
                this.clear_note_list();
                await this.post_delete_note(note_id);
                await this.update_list();
                this.loading = false;
            },
            update_list: async function() {
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
                    this.clear_note_list();
                    this.noteList = res.data.map(element => Object.create({id: element.id, title: element.title}));
                    console.dir(this.noteList);

                    console.log('this.noteList.length=' + this.noteList.length);
                }).catch(err => {
                    console.error("受信エラー: " + err);
                });
            },
            post_delete_note: async function(note_id) {
                try {
                    const res = await axios.post('/note/vue/delete/' + note_id);
                    console.log("Note削除 POST送信に成功, note_id=" + note_id, "res.status=" + res.status);
                } catch (err) {
                    console.error("受信エラー: " + err);
                }
            },
            clear_note_list: function() {
                this.noteList.splice(0, this.noteList.length);
            }
        }
    }
</script>