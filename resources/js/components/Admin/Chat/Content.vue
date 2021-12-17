<template>
    <!-- Chat: Content-->
    <div class="chat-content px-lg-4" ref="content">
        <div class="container-xxl py-4 py-lg-6">
           
            <div v-for="(message, index) in messages" :key="index" class="message" :class="{'message-right':message.is_operator}">
                <div class="message-body">
                    <div class="message-row">
                        <div class="d-flex align-items-center" :class="{'justify-content-end':message.is_operator}">
                            <div class="message-content" :class="{'bg-primary text-white':message.is_operator, 'bg-light':!message.is_operator}">
                                <div>
                                    {{message.text}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div v-if="loading" class="message">
                <div class="message-body">
                    <div class="message-row">
                        <div class="d-flex align-items-center">
                            <div class="message-content bg-light">
                                <div>
                                    Yüklənir<span
                                        class="typing-dots"
                                        ><span>.</span><span>.</span
                                        ><span>.</span></span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="end-of-chat"></div>
    </div>
</template>

<script>
export default {
    props:['messages', 'loading'],

    methods:{
        
        scrollToBottom(){
            setTimeout(()=>{
                this.$refs.content.scrollTop= this.$refs.content.scrollHeight-this.$refs.content.clientHeight;
            }, 50);
            
        }
    },

    watch:{
        messages(){
            this.scrollToBottom();
        }
    }
}
</script>

<style>
    .bot-message .message-row{
        cursor: pointer;
    }
</style>