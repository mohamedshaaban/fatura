<template>
    <div >
        <!--header Section Start Here-->

            <router-view :key="$route.params.pathMatch"></router-view>
        <!--footer Section Start Here-->
         <!--footer Section End Here-->
    </div>
</template>

<script>

    export default {

    }
</script>
