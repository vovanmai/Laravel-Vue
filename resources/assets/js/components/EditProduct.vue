<template>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Edit product</div>
            <div class="panel-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"  >Price:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter price">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Content:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter content">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
