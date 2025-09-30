<div class="content">
    <?php
    add_edit_form();
    ?>
    <div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <?php
                $this->load->view("includes/messages");
            ?>
            <div class="grid-title">
              <h4><?php echo $page_title; ?></h4>
            </div>
            <div class="grid-body ">
              <table class="table common_datatable" data-control="subcategory" data-mathod="manage" data-add-button="1">
                <thead>
                  <tr>
                    <th width="25%">SubCategory Name</th>
                    <th width="25%">SubCategory Image</th>
                    <th width="25%">Feature</th>
                    <th class="hidden-phone">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>


