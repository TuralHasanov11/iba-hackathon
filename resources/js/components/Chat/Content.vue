<template>
    <!-- Chat: Content-->
    <div class="chat-content px-lg-4" ref="content">
        <div class="container-xxl py-4 py-lg-6">
           
            <template v-if="botMode">
                <div v-for="(messageItem, index) in botMessages" :key="index" class="message bot-message">
                    <a class="avatar avatar-sm mr-4 mr-lg-5" href="javascript:void(0)">
                        <img class="avatar-img" src="/images/core-images/logo.png"/>
                    </a>

                    <div class="message-body">
                        <div v-for="(message,index) in messageItem" :key="index" class="message-row" @click="selectBotMessage(message)">
                            <div class="d-flex align-items-center">
                                <div class="message-content" :class="{
                                        'bg-primary text-white':selectedBotMessages.indexOf(message.id)!==-1,
                                        'bg-light':selectedBotMessages.indexOf(message.id)==-1,
                                    }">
                                    <div v-html="message.body">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="loading" class="message">
                    <a class="avatar avatar-sm mr-4 mr-lg-5" href="javascript:void(0)">
                        <img class="avatar-img" src="/images/core-images/logo.png"/>
                    </a>
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

            </template>

            <template v-else>
                <div v-for="(message, index) in messages" :key="index" class="message" :class="{'message-right':!message.is_operator}">
                    <a v-if="message.is_operator" class="avatar avatar-sm mr-4 mr-lg-5" href="javascript:void(0)">
                        <img class="avatar-img" src="/images/core-images/logo.png"/>
                    </a>

                    <div class="message-body">
                        <div class="message-row">
                            <div class="d-flex align-items-center" :class="{'justify-content-end':!message.is_operator}">
                                <div class="message-content" :class="{'bg-primary text-white':!message.is_operator, 'bg-light':message.is_operator}">
                                    <div>
                                        {{message.text}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </template>
        </div>

        <div class="end-of-chat"></div>
    </div>
</template>

<script>
export default {
    props:['messages', 'botMessages', 'botMode', 'selectedBotMessages', 'activeBotMessages','loading'],

    methods:{
        selectBotMessage(message){
            this.$emit('selectBotMessage', message);
        },

        scrollToBottom(){
            setTimeout(()=>{
                this.$refs.content.scrollTop= this.$refs.content.scrollHeight-this.$refs.content.clientHeight;
            }, 50);
        }
    },

    watch:{
        messages(){
            this.scrollToBottom();
        },

        botMode(){
            this.scrollToBottom()
        },

        botMessages(){
            this.scrollToBottom()
        }
    }
}
</script>

<style>
    .bot-message .message-row{
        cursor: pointer;
    }
</style>