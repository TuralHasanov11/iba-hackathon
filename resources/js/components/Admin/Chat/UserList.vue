<template>
            <div class="sidebar">
                <div class="tab-content h-100" role="tablist">
                    <div class="tab-pane fade h-100 show active" id="tab-content-dialogs" role="tabpanel">
                        <div class="d-flex flex-column h-100">

                            <div class="hide-scrollbar">
                                <div class="container-fluid py-6">

                                    <h2 class="font-bold mb-6">Müştərilər</h2>

                                    <!-- <form class="mb-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-lg" placeholder="Search for messages or users..." aria-label="Search for messages or users...">
                                            <div class="input-group-append">
                                                <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                                                    <i class="fe-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form> -->


                                    <nav class="nav d-block list-discussions-js mb-n6">

                                        <div v-for="(user,index) in users" :key="index" class="text-reset nav-link p-0 mb-6" @click="selectUser(user)">
                                            <div class="card card-active-listener">
                                                <div class="card-body">

                                                    <div class="media">
                                                        <div class="media-body overflow-hidden">
                                                            <div class="d-flex align-items-center mb-1">
                                                                <h6 class="text-truncate mb-0 mr-auto">Müştəri: {{user.from}}</h6>
                                                            </div>
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </nav>

                                </div>
                            </div>

                        </div>
                    </div>

                 

                   
                </div>
            </div>

</template>

<script>
export default {
    props:['users'],

    methods:{
        selectUser(user){
            this.$emit('selectUser', user)
        }
    }
}
</script>