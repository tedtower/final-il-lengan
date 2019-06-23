<body style="background: white">
<div class="content">
    <div class="container-fluid">
    <br>
        <div class="content" style="margin-left:250px;">
            <div class="container-fluid">
            <!--Date and Time-->
                <div style="overflow:auto">
                    <p style="text-align:right; font-weight: regular; font-size: 16px;float:right"><?php echo date("M j, Y -l"); ?> </p>
                </div>               
            <!--Card Container--> 
                <div style="overflow:auto">
                <!--Card--> 
                    <div class="card" style="float:left;width:60%">
                        <div class="card-header">
                            <h6 style="font-size:15px;">Add Consumption</h6>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-secondary"
                                        style="width:125px;background:#8c8c8c;color:white;font-size:14px;font-weight:600">
                                        Date Consumed</span>
                                </div>
                                <input type="date" class="form-control" name="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-secondary"
                                        style="width:125px;background:#8c8c8c;color:white;font-size:14px;font-weight:600">
                                        Remarks</span>
                                </div>
                                <textarea type="text" name="remarks"
                                    class="form-control form-control-sm  border-left-0"
                                    rows="1"></textarea>
                            </div>
                            <div class="ic-level-2">
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th>Stock Item</th>
                                            <th width="17%">Quantity</th>
                                            <th width="33%">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td style="padding:1% !important"><input type="text" class="form-control " name="stName"></td>
                                            <td style="padding:1% !important"><input type="number" class="form-control" name="cQty"></td>
                                            <td style="padding:1% !important"><textarea type="text" class="form-control" name="remarks" rows="1"></textarea></td>
                                        </tr>
                                        <tr> 
                                            <td style="padding:1% !important"><input type="text" class="form-control " name="stName"></td>
                                            <td style="padding:1% !important"><input type="number" class="form-control" name="cQty"></td>
                                            <td style="padding:1% !important"><textarea type="text" class="form-control" name="remarks" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <span>Total: &#8369;<span class="total">0</span></span>
                        </div>
                        <div class="card-footer">
                            <div>
                                <button type="button" class="btn btn-danger btn-sm" style="background:white;margin-left:0" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm" style="background:white" type="submit">Insert</button>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="float:left;width:37%;margin-left:3%">
                        <div class="card-header" style="overflow:auto">
                            <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select Stock Items</div>
                            <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" placeholder="Search...">
                            </div>
                        </div>
                        <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                            <!--checkboxes-->
                            <table class="table table-borderless">
                                <thead style="border-bottom:2px solid #cccccc">
                                    <tr>
                                        <th width="2%"></th>
                                        <th>Stock Item</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="mr-2" value=""></td> 
                                        <td>Strawberry Syrup 1000 ml</td> 
                                        <td>Condiments</td> 
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="mr-2" value=""></td> 
                                        <td>Strawberry Syrup 1000 ml</td> 
                                        <td>Condiments</td> 
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="mr-2" value=""></td> 
                                        <td>Strawberry Syrup 1000 ml</td> 
                                        <td>Condiments</td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <!--End of container divs-->    
            </div>
        </div>
    </div>
</div>


                    
<script>
</script>
</body>
</html>