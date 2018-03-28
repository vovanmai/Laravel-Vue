<template>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Add product</div>
            <div class="panel-body">
                <form v-on:submit.prevent="addProduct" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="email">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="name" class="form-control" id="email" placeholder="Enter name">
                            <div class="alert alert-danger" v-if="messages.name" style="margin-top: 10px;margin-bottom: -3px;">
                                <strong>{{messages.name[0]}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-1">Price:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="price" class="form-control" placeholder="Enter price">
                            <div class="alert alert-danger" v-if="messages.price" style="margin-top: 10px;margin-bottom: -3px;">
                                <strong>{{messages.price[0]}}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1">Image:</label>
                        <div class="col-sm-10">
                            <input type="file" @change="addFile" ref="file" class="form-control" placeholder="Enter price">
                            <div class="alert alert-danger" v-if="messages.file" style="margin-top: 10px;margin-bottom: -3px;">
                                <strong>{{messages.file[0]}}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" >Content:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="content" class="form-control" placeholder="Enter content">
                            <div class="alert alert-danger"  v-if="messages.content" style="margin-top: 10px;margin-bottom: -3px;">
                                <strong>{{messages.content[0]}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">Add</button>
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
                messages: {},
                attachment: '',
                formData: {},
                name: '',
                price: '',
                content: '',
            }
        },
        methods: {
            addFile() {
                this.attachment = this.$refs.file.files[0];
            },
            addProduct(){
                this.formData = new FormData();
                this.formData.append('name', this.name);
                this.formData.append('price', this.price);
                this.formData.append('file', this.attachment);
                this.formData.append('content', this.content);

                var resource = this.$resource('products', {});
                resource.save({}, this.formData).then(function(response) {
                    this.messages = {};
                    // window.location.href = "/";
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
