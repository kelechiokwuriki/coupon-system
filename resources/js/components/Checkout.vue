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
                                                $100
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
    }
}
</script>
