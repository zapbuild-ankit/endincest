<template>
    <div>
        <vue-topprogress ref="topProgress"></vue-topprogress>
        <div class="row">
            <div class="container">
                <div>
                    <center><h5>Edit Article</h5></center>
                </div>
                <form>
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="title" type="text" class="validate" v-model="title">
                                <!--<label for="title">Title</label>-->
                                <span class="text text-danger" v-if="error && errors.title">{{ errors.title[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" class="materialize-textarea" data-length="120" v-model="description"></textarea>
                                <!--<label for="description">Description</label>-->
                                <span class="text text-danger" v-if="error && errors.description">{{ errors.description[0] }}</span>
                            </div>
                        </div>
                    </div><br />
                    <div class="form-group">
                        <button class="btn btn-block waves-effect waves-light submit" type="button" name="action" @click="update()">Update</button>
                    </div>
                </form>
             </div>
        </div>
    </div>
</template>
 
<script>
    export default {
 
        data() {
 
            return {
                title: '',
                description: '',
                error: false,
                errors:{}
            }
 
        },
        created() {
            let uri = `/api/edit/${this.$route.params.id}/article`;
            this.axios.get(uri).then(response => {
                if(response.data.success == true)
                {
                    this.title = response.data.data.title;
                    this.description = response.data.data.description;
                }
            });
        },
 
        mounted () {
 
        },
 
        methods: {
            update() {
                let uri = `/api/update/${this.$route.params.id}/article`;
                var dataToSubmit = {
                    title: this.title,
                    description: this.description,
                };
                this.axios.post(uri, dataToSubmit).then(response => {
                    this.$toaster.success('Article Edited Successfully...');
                    this.$router.push({name: 'view'});
                }).catch(error => {
                    this.error = true;
                    this.errors = error.response.data.errors
                });;
            }
        }
    }
</script>
<style scoped>
    .btn{
        background-color: #337ab7!important;
    }
    .btn:focus{
        color:white;
    }
</style>