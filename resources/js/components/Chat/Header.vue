<template>
<!-- Chat: Header -->
    <div class="chat-header border-bottom py-2 py-lg-4 px-lg-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <!-- Close chat(mobile) -->
                <div class="col-3 d-xl-none">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a
                                class="text-muted px-0"
                                href="#"
                                data-chat="open"
                            >
                                <i
                                    class="icon-md fe-chevron-left"
                                ></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Chat photo -->
                <div class="col-7 col-xl-7">
                    <div class="media text-center text-xl-left">
                        <div
                            class="avatar avatar-sm d-none d-xl-inline-block mr-5"
                        >
                            <img
                                src="/images/core-images/logo.png"
                                class="avatar-img"
                                alt=""
                            />
                        </div>

                        <div
                            class="media-body align-self-center"
                        >
                            <h6 class="mb-n1">
                                <span v-if="bot">
                                    IBAB (Çat Bot)
                                </span>
                                <span v-else>
                                    Operator
                                </span>
                            </h6>
                           
                        </div>
                    </div>
                </div>

                <div class="col-4 text-center">
                    <div class="media text-center text-xl-left">
                        <div class="media-body align-self-center">
                            <small v-if="bot" @click="operatorMode" class="badge badge-primary" style="cursor:pointer;">
                                Operatora bağlan
                            </small>
                            <small v-else @click="botMode" class="badge badge-info" style="cursor:pointer;">
                                Bot modu
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .row -->
        </div>
    </div>
    <!-- Chat: Header -->
</template>

<script>
export default {
    props:['bot'],
    methods:{
        botMode(){
            this.$emit('changeMode',true)
        },

        operatorMode(){
            this.$emit('changeMode',false)
        }
    }
}
</script>