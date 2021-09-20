<template>
    <div>

    </div>
</template>

<script>

    export default {
         data(){
            return {


            }
        },
        mounted() {

            axios.all([
                axios.get('/api/home-menus'),
            ])
            .then(axios.spread((menuResponse) => {
                this.meuns     = menuResponse.data;
            })).then((result) => {
                $("#load").hide();

            });

        },
        computed: {

        },
        updated: function () {
            // Global this for player video
             var $this = this;





        },


        methods: {

        }
    }
</script>

