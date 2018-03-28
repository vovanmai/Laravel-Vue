<template>
    <div class="container">
        <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
    </div>
</template>

<script>
    import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

    export default {
        data () {
            return {
                color: '#4fc08d',
                color1: '#5bc0de',
                size: '45px',
                margin: '2px',
                radius: '2px',
            }
        },
        components: {
            PulseLoader,
        }
    }
</script>