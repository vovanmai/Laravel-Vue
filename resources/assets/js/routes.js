
import VueRouter from 'vue-router';
import ListProduct from './components/ListProduct.vue'
import AddProduct from './components/AddProduct.vue'
import EditProduct from './components/EditProduct.vue'
import NotFound from './components/NotFound.vue'

let routes = [
    {
        path:'/',
        component: ListProduct,
    },
    {
        path:'/products/add',
        component: AddProduct,
    },


    {
        path:'/products/edit/:id',
        component: EditProduct,
    },
    {
        path: '*',
        component: NotFound,
    }
];

export default new VueRouter({
    routes:routes,
    mode: 'history',
    redirect: {
        '*' : '/'
    }
})