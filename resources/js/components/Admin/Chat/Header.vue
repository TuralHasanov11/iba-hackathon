<template>
    <div class="chat-header border-bottom py-2 py-lg-4 px-lg-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="col-5 col-xl-5">
                    <div class="media text-center text-xl-left">
                        <div
                            class="avatar avatar-sm d-none d-xl-inline-block mr-5"
                        >
                            
                        </div>

                        <div
                            class="media-body align-self-center text-truncate"
                        >
                            <h6 class="text-truncate mb-n1">
                                {{selectedUser?selectedUser.from:'Çat'}}
                            </h6>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['selectedUser']
}
</script>