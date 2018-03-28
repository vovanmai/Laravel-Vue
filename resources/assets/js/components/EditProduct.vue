<template>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Edit product</div>
            <div class="panel-body">
                <form v-on:submit.prevent="editProduct" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-1">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="form_data.name" class="form-control" placeholder="Enter name">
                            <div class="alert alert-danger" v-if="messages.name" style="margin-top: 10px;margin-bottom: -3px;">
                                <strong>{{messages.name[0]}}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1">Price:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="form_data.price" class="form-control" placeholder="Enter price">
                            <div class="alert alert-danger" v-if="messages.price" style="margin-top: 10px;margin-bottom: -3px;">
                                <strong>{{messages.price[0]}}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" >Content:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="form_data.content" class="form-control" placeholder="Enter content">
                            <div class="alert alert-danger"  v-if="messages.content" style="margin-top: 10px;margin-bottom: -3px;">
                                <strong>{{messages.content[0]}}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import VueResource from 'vue-resource'
    Vue.use(VueResource);

    export default {
        data() {
            return {
                id: this.$route.params.id,
                form_data:{},
                messages: {},
                items: {},
            }
        },

        created() {
            var resource = this.$resource('products{/id}');
            resource.get({id: this.id}).then(response => {
                this.items = response.body;
            });
        },

        methods: {
            editProduct(){
                var resource = this.$resource('products{/id}', {});
                resource.update({id: this.id}, this.form_data).then(function(response) {
                    window.location.href = "/";
                }, function(response) {
                    if(response) {
                        this.messages = response.data;
                    }
                });
            },
        },
        http: {
            root: '/api',
            headers: {
                Accept: 'application/json',
            }
        },
    }
</script>
