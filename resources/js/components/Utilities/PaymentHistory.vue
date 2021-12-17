<template>
    <div class="payment-history">
        <form @submit.prevent="onSubmit">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kart nömrəsi - Card number</label>
                <input type="text" class="form-control" v-model="cardNumber" placeholder="xxxx xxxx xxxx xxxx">
            </div>
            <button type="submit" class="btn btn-primary">Təsdiq et</button>
        </form>
        <hr>
        <div class="history-chart">
            <canvas ref="canvas"></canvas>
        </div>

    </div>
</template>

<script>
import axios from 'axios'

export default {
   
    data(){
        return {
            cardNumber:null,
            history:[],
            categoires:[],
            colors:[],
        }
    },

    

    methods:{
        onSubmit(){

            if(this.cardNumber==''){
                return;
            }

            axios.get(`/api/utilities/payment-history/${this.cardNumber}`)
                .then((res)=>{
                    this.history=res.data

                    // this.renderChart({
                    //     labels: this.categoires.map(c => c.name),
                    //     datasets: [{
                    //         label: 'Расходы по категориям',
                    //         data: this.categoires.map(c => {
                    //         return this.history.reduce((total, r) => {
                    //             if (r.category.id === c.id) {
                    //                 total += +r.amount
                    //             }
                    //             return total
                    //         }, 0)
                    //         }),
                    //         backgroundColor: this.colors,
                    //         borderColor: this.colors,
                    //         borderWidth: 1
                    //     }]
                    // })
                })
                .catch((e)=>{
                    console.log(e);
                });
        },


        random_rgba() {
            var o = Math.round, r = Math.random, s = 255;
            return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
        }

    },

    mounted(){
        axios.get('/api/utilities/payment-categories')
            .then((res)=>{
                this.categories = res.data
                this.colors = new Array(this.categoires.length).fill(this.random_rgba())
            })
    }


}
</script>