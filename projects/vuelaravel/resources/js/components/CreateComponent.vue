<template>
    <div class="row">
        <div class="container">
            <div>
                <center><h5>Add Article</h5></center>
            </div>
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="title" type="text" class="validate" v-model="title">
                        <label for="title">Title</label>
                        <span class="text text-danger" v-if="error && errors.title">{{ errors.title[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="description" class="materialize-textarea" data-length="120" v-model="description"></textarea>
                        <label for="description">Description</label>
                        <span class="text text-danger" v-if="error && errors.description">{{ errors.description[0] }}</span>
                    </div>
                </div>
                <button class="btn btn-block waves-effect waves-light submit" type="button" name="action" @click="submit()">Submit</button>
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
                errors: {}
            }
        },
 
        methods: {
 
            //save article
 
            submit: function() {
 
                let self = this;
                var dataToSubmit = {
                    title: this.title,
                    description: this.description,
                };
 
                this.axios.post('api/article/create', dataToSubmit)
                    .then(function (response) {
                        if(response.data.success == true)
                        {
                            self.title =  '';
                            self.description = '';
                            self.$toaster.success('Article Saved Successfully...');
                            self.$router.push({name: 'view'})
                        }
                    })
                    .catch(error => {
                        this.error = true;
                        this.errors = error.response.data.errors
                    });
            }
        },
    }
</script>