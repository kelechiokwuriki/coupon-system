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
                                                    <h6 class="card-subtitle mb-2 text-muted">${{item.price}}</h6>
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
                                                ${{ getTotalAmount }}
                                            </div>
                                        </div>
                                        <form class="mt-4">
                                            <div class="form-group">
                                                <label for="coupon-text">Enter coupon</label>
                                                <input type="text" class="form-control" id="coupon-text" placeholder="e.g abcd">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Try coupon</button>
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
            items: []
        }
    },
    mounted() {
        this.getItems();
    },
    methods: {
        async getItems() {
            const items = await axios.get('/api/item');
            this.items = items.data;
        }
    },
    computed: {
        getTotalAmount: function() {
            return 0.00;
        }
    }
}
</script>
