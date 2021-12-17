<template>
    <div class="main main-visible" data-mobile-height="">
        <div id="chat-1" class="chat dropzone-form-js" data-dz-url="some.html">
            <div class="chat-body">
                
                <app-header @changeMode="changeMode" :bot="botMode"></app-header>

                <app-search></app-search>

                <app-content :messages="messages" 
                    :botMessages="botMessages" 
                    :botMode="botMode" 
                    @selectBotMessage="selectBotMessage" 
                    :selectedBotMessages="selectedBotMessages" 
                    :loading="loading"
                >
                </app-content>

                <app-footer v-if="!botMode" @newMessage="saveNewMessage" :uuid="uuid"></app-footer>

            </div>

        </div>
    </div>
</template>

<script>
import Header from './Header.vue'
import Footer from './Footer.vue'
import Search from './Search.vue'
import Content from './Content.vue'
import axios from 'axios'

export default {
    components:{
        appHeader:Header,
        appFooter:Footer,
        appSearch:Search,
        appContent:Content,
    },

    props:['uuid'],

    data(){
        return {
            messages:[],
            botMode:true,
            selectedBotMessages:[],
            botMessages:[],
            loading:false,
        }
    },

    methods:{
        
        selectBotMessage(message){
            let index = this.selectedBotMessages.indexOf(message.id)
            if(index==-1){
                let msgIndex = null;

                if(msgIndex = this.checkBotMessage(message.id)){
                    let deleted = this.botMessages.splice(parseInt(msgIndex)+1)
                    
                    this.selectedBotMessages.splice(msgIndex)

                    this.getBotMessages(message.id, message.children)
                }
                
                this.selectedBotMessages.push(message.id)
                
            }else{
                return;
            }
        },

        checkBotMessage(msgId){
            let msg = {}
            for (let msgItem in this.botMessages) {
                msg = this.botMessages[msgItem].find((el)=>{
                    return msgId == el.id
                })

                if(msg){
                    return msgItem;
                }
            }

            return false
        },

        changeMode(mode){
            this.botMode=mode;
            if(!mode){
                this.clearBot()
                this.getBotMessages()
            }
        },

        clearBot(){
            this.botMessages = []
            this.selectedBotMessages = []
        },

        getBotMessages(messageId=null, children=1){
            if(!messageId || children>0){
                this.loading=true
                axios.get(`/api/bot_messages${messageId?'?parent='+messageId:''}`)
                    .then((res)=>{
                        if(res.data && res.data.length>0){
                            this.botMessages.push(res.data)
                        }else{
                            this.loading=false
                            return;
                        }
                        this.loading=false
                    })
                    .catch((e)=>{
                        console.log(e)
                    })
            }else{
                return;
            }
        },

        saveNewMessage(message){
            this.messages.push(message);
        },

        handleIncoming(message){
            this.messages.push(message);
            return;
        },
            
        
        startMessaging(){
            axios.get(`/api/messages?uuid=${this.uuid}`)
                .then((res)=>{
                    this.messages=res.data;
                });
        },

    },

    mounted(){
        this.getBotMessages()
        this.startMessaging()
        window.Echo.channel(`messages.${this.uuid}`)
            .listen('NewMessage',(e)=>{
                this.handleIncoming(e.message);
            });

    }

}
</script>

