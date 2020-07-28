    <template>
    <div>
        <vue-topprogress ref="topProgress"></vue-topprogress>
        <div class="container">
            <table class="centered">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(article,key) in articles" :key="article.id">
                    <td>{{ key+1 }} </td>
                    <td>{{ article.title }}</td>
                    <td>{{ article.description }}</td>
                    <td><router-link :to="{ name: 'edit', params: { id: article.id }}"><i class="fa fa-pencil-square-o"></i></router-link> | <button type="button" @click.prevent="deletePost(article.id, key)"><i class="fa fa-trash-o"></i></button></td>
                </tr>
            </table>
        </div>
    </div>
</template>
 
<script>
 
    export default {
 
        data() {
 
            return {
                articles: [],
            }
        },
 
        created() {
            this.axios.get('api/articles').then(response => {
                this.articles = response.data.data;
            });
        },
 
        mounted () {
           
        },

methods: {
            deletePost: function(id, key)
            {
                this.$swal({
                    title: 'Are you sure?',
                    text: 'You can\'t revert your action',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes Delete it!',
                    cancelButtonText: 'No, Keep it!',
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        let uri = `/api/post-delete`;
 
                        var dataToSubmit = {
                            deleteId: id,
                        };
                        this.axios.post(uri, dataToSubmit).then(response => {
                            if (response.data.success == true)
                                this.articles.splice(key, 1);
                            this.$toaster.success('Article Deleted Successfully...');
                        });
                    }
                })
            }
        },
    }
    
</script>