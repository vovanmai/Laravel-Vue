<template>
    <div>
        <h2>Articles</h2>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#"
                @click=fetchArticles(pagination.prev_page_url)
                >Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]"><a class="page-link" href="#" @click=fetchArticles(pagination.next_page_url)>Next</a></li>
            </ul>
        </nav>

        <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
            <h3>{{article.name}}</h3>
            <h2>{{article.price}}</h2>
            <p>{{article.content}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                articles: [],
                article: {
                    id: '',
                    name: '',
                    price: '',
                    content: '',
                },
                article_id: '',
                pagination: {},
                edit: false
            }
        },
        created() {
            this.fetchArticles();
        },
        methods: {
            fetchArticles(page_url) {
                page_url = page_url || 'api/products';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.articles = res.data;
                        let paginate = {
                            current_page: res.current_page,
                            last_page: res.last_page,
                            next_page_url: res.next_page_url,
                            prev_page_url: res.prev_page_url,
                        };
                        this.pagination = paginate;
                    })
            }
        }
    }
</script>