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
    <table class="table align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Person Name</th>
                <th scope="col">Designation</th>
                <th scope="col">Mobile</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            if(count($person_data) > 0) {
                foreach($person_data as $person) { ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $person->person_name;?></td>
                    <td><?php echo $person->designation_name;?></td>
                    <td><?php echo $person->person_mobile;?></td>
                    <td><?php echo $person->person_email;?></td>
                </tr>
                <?php $i++;
                }
            } else { ?>
                <tr><td colspan="5" class="text-center">No person found</td></tr>
            <?php } ?>    
        </tbody>
    </table>
    <!-- end table -->
</div>
<!-- end table responsive -->



