<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Checkout</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-header">
                                        Items
                                    </div>
                                    <div class="card-body">
                                        <div class="row" >
                                            <div class="col-sm-6" v-for="item in items" v-bind:key="item.id">
                                                <div class="card mb-4" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ item.name }}</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">${{ item.price }}</h6>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                 <div class="card">
                                    <div class="card-header">
                                        Checkout Details
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                Total Amount
                                            </div>
                                            <div class="col-sm-6">
                                                ${{ totalAmount }}
                                            </div>
                                        </div>
                                        <form class="mt-4">
                                            <div class="form-group">
                                                <label for="coupon-text">Enter coupon</label>
                                                <input type="text" class="form-control" v-model="couponCode" id="coupon-text" placeholder="e.g abcd">
                                            </div>
                                            <button type="submit" class="btn btn-primary" @click="submitCoupon">Submit coupon</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            items: [],
            couponCode: '',
            totalAmount: 0.00
        }
    },
    mounted() {
        this.getItems();
    },
    methods: {
        getTotalAmount() {
            if (this.items.length) {
                this.totalAmount = this.items.reduce((a, b) => {
                    return a + b['price'];
                }, 0);
            }
        },
        async getItems() {
            const items = await axios.get('/api/item');
            this.items = items.data;

            this.getTotalAmount();
        },
        async submitCoupon(e) {
            e.preventDefault();

            const data = {
                cartTotalAmount: this.totalAmount,
                code: this.couponCode,
                cartTotalNumberOfItems: this.items.length
            }

        const result = await axios.post('/api/process-coupon', data);
        console.log(result);
        }
    },
    // computed: {
    //     getTotalAmount: function() {
    //         this.getTotalAmount();
    //     }
    // }
}
</script>
