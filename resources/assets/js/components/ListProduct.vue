<template>
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">List Products</div>
                <div class="panel-body" style="padding: 7px">
                    <div class="text-right" style="margin-bottom: 7px">
                        <router-link to="/products/add">
                            <a type="button" href="" class="btn btn-info">Add products</a>
                        </router-link>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="15%" class="text-center">id</th>
                                <th width="20%" class="text-center">Name</th>
                                <th width="20%" class="text-center">Price</th>
                                <th width="20%" class="text-center">Image</th>
                                <th width="25%" class="text-center">Functions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in products">
                                <td class="text-center">{{ product.id }}</td>
                                <td class="text-center">{{ product.name }}</td>
                                <td class="text-center">{{ product.price }}$</td>
                                <td class="text-center">
                                    <img style="height: 150px; width: 150px;" :src="'/storage/images/'+ product.image" alt="">
                                </td>
                                <td class="text-center">
                                    <router-link :to="'/products/edit/'+product.id">
                                        <a type="button" class="btn btn-primary">Edit</a>
                                    </router-link>
                                    <a type="button" v-on:click.prevent= deleteProduct(product.id,index) class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-right">
                        <ul class="pagination">
                            <li v-bind:class="{ disabled : !pagination.prev_page_url }"><a v-on:click=fetchProducts(pagination.prev_page_url) >Previous</a></li>
                            <li v-for="pageNumber in pagination.last_page" v-bind:class="{active: pagination.current_page == pageNumber}"><a v-on:click=fetchProducts(pagination.tmp_url+pageNumber) >{{pageNumber}}</a></li>
                            <li v-bind:class="{ disabled: !pagination.next_page_url }"><a v-on:click=fetchProducts(pagination.next_page_url) >Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                products: [],
                product: {
                    id: '',
                    name: '',
                    price: '',
                    content: '',
                },
                product_id: '',
                pagination: {},
                edit: false,
            }
        },
        created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts(page_url) {
                page_url = page_url || 'products';
                var resource = this.$resource(page_url);
                resource.get({}).then(response => {
                    this.products = response.body.data;
                    let tmp_url = window.location.origin + "/api/products?page=";
                    let paginate = {
                        current_page: response.body.current_page,
                        last_page: response.body.last_page,
                        next_page_url: response.body.next_page_url,
                        prev_page_url: response.body.prev_page_url,
                        prev_page_url: response.body.prev_page_url,
                        tmp_url: tmp_url,
                    };
                    this.pagination = paginate;
                });
            },
            deleteProduct(id, index) {
                var resource = this.$resource('products{/id}');
                resource.delete({id: id}).then(response => {
                    this.$delete(this.products, index);
                }, response => {
                    // error callback
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