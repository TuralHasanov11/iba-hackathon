<template>
    <div class="chat-footer border-top py-2 py-lg-4">
        <div class="container-xxl">
            <form @submit.prevent="send"
                id="chat-id-1-form"
                action="https://themes.2the.me/Messenger-1.1/demo-light/assets/php/upload.php"
                data-emoji-form=""
            >
                <div class="form-row align-items-center">
                    <div class="col">
                        <div class="input-group">
                            <textarea
                                id="chat-id-1-input"
                                class="form-control bg-transparent border-0"
                                placeholder="Type your message..."
                                rows="1"
                                data-emoji-input=""
                                data-autosize="true"
                                v-model="message"
                                @keydown.enter="send"
                            ></textarea>

                            <div class="input-group-append">
                                <button
                                    class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0"
                                    type="button"
                                    data-emoji-btn=""
                                >
                                    <img
                                        src="/images/smile.svg"
                                        data-inject-svg=""
                                        alt=""
                                    />
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <button
                            class="btn btn-ico btn-primary rounded-circle"
                            type="submit"
                        >
                            <span class="fe-send"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props:['uuid'],
    data(){
        return {
            message:null,
        }
    },

    methods:{
        send(e){
            e.preventDefault();
            if(this.message==''){
                return;
            }
            axios.post('/api/messages',{
                text:this.message,
                is_operator:true,
                from:this.uuid
            }).then((res)=>{
                this.message='';
            }).catch((e)=>{
                console.log(e)
            });
        },
    }
}
</script>