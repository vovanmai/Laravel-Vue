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
                            <th width="25%" class="text-center">id</th>
                            <th width="25%" class="text-center">Name</th>
                            <th width="25%" class="text-center">Price</th>
                            <th width="25%" class="text-center">Functions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in products">
                            <td class="text-center">{{ product.id }}</td>
                            <td class="text-center">{{ product.name }}</td>
                            <td class="text-center">{{ product.price }}$</td>
                            <td class="text-center">
                                <router-link :to="'/products/edit/'+product.id">
                                    <a type="button" class="btn btn-primary">Edit</a>
                                </router-link>
                                <a type="button" class="btn btn-danger">Delete</a>
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
                page_url = page_url || 'api/products';
                console.log(page_url);
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.products = res.data;
                        let tmp_url = window.location.origin + "/api/products?page=";
                        let paginate = {
                            current_page: res.current_page,
                            last_page: res.last_page,
                            next_page_url: res.next_page_url,
                            prev_page_url: res.prev_page_url,
                            prev_page_url: res.prev_page_url,
                            tmp_url: tmp_url,
                        };
                        this.pagination = paginate;
                    })
            }
        }
    }
</script>