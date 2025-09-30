<style type="text/css">
.pull-right.buttom_rights.pos_btn {
    float: none !important;
    display: block;
    position: absolute;
    z-index: 111;
    top: 27px;
    left: 15px;
}
#DataTables_Table_0 {
    width: 100% !important;
}
.content.modal-content .span12 {
    position: relative;
}
</style>

    <div class="table-responsive">
            <table class="table table-rounded table-striped border gy-7 gs-7">
                <thead>
                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th>#</th>
                        <th>Range</th>
                        <th>Price</th>
                        <th>Specification</th>
                    </tr>
                </thead>
                <tbody class="fs-6">
                    <?php 
                    $i=1;
                    if(count($price_data) > 0) {
                        foreach($price_data as $price) { ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $price->size_range;?></td>
                            <td><?php echo $price->price;?></td>
                            <td><?php echo $price->description;?></td>
                        </tr>
                        <?php $i++;
                        }
                    } else { ?>
                        <tr><td colspan="5" class="text-center">No data found</td></tr>
                    <?php } ?>    
                </tbody>
            </table>
            <!-- end table -->
        </div>
        <!-- end table responsive -->
    

