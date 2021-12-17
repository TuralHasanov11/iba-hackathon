<template>
    <div class="card-body p-0 row">
        <div class="col-4">
            <app-user-list :users="users" @selectUser="selectUser"></app-user-list>
        </div>
        <div class="col-8">
            <div id="chat-1" class="chat">
                <div class="chat-body">
                    
                    <app-header :selectedUser="selectedUser"></app-header>

                    <app-content :messages="messages" :loading="loading"></app-content>

                    <app-footer v-if="selectedUser" @newMessage="saveNewMessage" :uuid="selectedUser.from"></app-footer>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
import Header from './Header.vue'
import Footer from './Footer.vue'
import Content from './Content.vue'
import UserList from './UserList.vue'
import axios from 'axios'

export default {
    components:{
        appHeader:Header,
        appFooter:Footer,
        appContent:Content,
        appUserList:UserList,
    },

    data(){
        return {
            messages:[],
            loading:false,
            users:[],
            selectedUser:null,
        }
    },

    methods:{

        saveNewMessage(message){
            this.messages.push(message);
        },

        handleIncoming(message){
            this.messages.push(message);
            return;
        },
        
        getUsers(){
            axios.get('/api/admin/customers')
                .then((res)=>{
                    this.users = res.data
                });
        },

        selectUser(user){
            this.loading=true
            this.selectedUser = user
            this.clearMessages()
            axios.get(`/api/messages?uuid=${user.from}`)
                .then((res)=>{
                    if(res.data.length>0){
                        this.messages = res.data
                        this.startConveration()
                    }
                    this.loading=false
                });
        },

        clearMessages(){
            this.messages = []
        },

        startConveration(){
            window.Echo.channel(`messages.${this.selectedUser.from}`)
                .listen('NewMessage',(e)=>{
                    this.handleIncoming(e.message);
                });
        }

    },

    mounted(){
        this.getUsers()
    }

}
</script>

