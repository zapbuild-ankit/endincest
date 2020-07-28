<template>
    <div>
        <vue-topprogress ref="topProgress"></vue-topprogress>
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        
                        <li>
                            <router-link :to="{ name: 'view' }">View</router-link>
                        </li>

                        <li>
                            <router-link :to="{ name: 'create' }">Create</router-link>
                        </li>
                    </ul>
                    <ul class="right">
                        
                    </ul>
                </div>
            </div>
        </nav>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    <span>&copy; 2018</span>  <a href="https://zapbuild.com" target="_blank" style="color:white;text-decoration:none">Zapbuild technologies</a>
                </div>
            </div>
        </footer>
    </div>
</template>
 
<script>
 
    export default {
 
        mounted () {
 
        },
 
        methods: {
 
        },
        beforeRouteUpdate (to, from, next) {
            console.log('beforeRouteUpdate')
            // react to route changes...
            // don't forget to call next()
        },
        watch: {
            '$route' (to, from) {
                console.log('watch')
                // react to route changes...
                this.$refs.topProgress.start();
                setTimeout(() => {
                    this.$refs.topProgress.done()
                }, 1000)
            }
        }
    }
 
</script>
 
<style scoped>
    /*.fade-enter-active, .fade-leave-active {*/
        /*transition: opacity .5s*/
    /*}*/
    /*.fade-enter, .fade-leave-active {*/
        /*opacity: 0*/
    /*}*/
 
    .fade-enter-active,
    .fade-leave-active {
        transition-duration: 0.2s;
        transition-property: opacity;
        transition-timing-function: ease;
    }
 
    .fade-enter,
    .fade-leave-active {
        opacity: 0
    }
 
    .container{
        padding:0px;
    }
    #nav-mobile a:hover{
        text-decoration: none !important;
        color:white;
    }
    #nav-mobile a:focus{
        text-decoration: none !important;
        color:white;
        background-color:rgba(0,0,0,0.1);
    }
 
    .page-footer{
        padding-top:0px;
        position:fixed;
        bottom:0;
        width:100%;
        z-index: 1;
    }
    .github
    {
        font-size:25px;
    }
 
    .github:hover{
        color:white;
    }
 
    .github:focus{
        color:white;
    }
 
</style>