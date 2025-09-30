        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php $this->load->view('partials/page-title', array('pagetitle'=>'Home','title'=>'Quotations')); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">Search</h5>
                                </div>
                                
                                <div class="card-body border-bottom border-bottom-dashed p-4">
                                    <form>
                                    <div class="row g-3">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="industry_type-field" class="form-label">Company</label>
                                                <select class="form-control js-example-basic-single select2 search_mq" id="rep_company_id" name="company_id">
                            						<option value="" selected>Select Company</option>
                                                    <?php 
                                                    if($companies) {
                                                        foreach($companies as $key=>$value) { ?>
                                						<option value="<?php echo $key;?>"><?php echo $value;?></option>
                                						<?php }
                                					} ?>
                            					</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="industry_type-field" class="form-label">Users</label>
                                                <select class="form-control js-example-basic-single select2 search_mq" id="user_id" name="user_id">
                            						<option value="" selected>Select Person</option>
                                                    <?php 
                                                    if($users) {
                                                        foreach($users as $key=>$value) { ?>
                                						<option value="<?php echo $key;?>"><?php echo $value;?></option>
                                						<?php }
                                					} ?>
                            					</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="from_date" class="form-label">From Date</label>
                                                <input type="text" id="from_date" name="from_date" class="form-control date-field search_mq" placeholder="Enter date" data-provider="flatpickr" data-date-format="d-m-Y" readonly/>
                                                <div class="invalid-tooltip">Please enter date</div>
                                            </div>
                                        </div>       
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="to_date" class="form-label">To Date</label>
                                                <input type="text" id="to_date" name="to_date" class="form-control date-field search_mq" placeholder="Enter date" data-provider="flatpickr" data-date-format="d-m-Y" readonly/>
                                                <div class="invalid-tooltip">Please enter date</div>
                                            </div>
                                        </div>                                        
                                        <!--end row-->
                                        
                                        <!--end row-->
                                    </div>
                                    </form>
                                </div>    
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">Quotations</h5>
                                </div>
                                <div class="card-body">
                                    <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle common_datatable" data-control="report" data-mathod="manage_quotations" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Quotation Date</th>
                                                <th>Reference No</th>
                                                <th>Customer Name</th>
                                                <th>CustomerRef No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

             <?php $this->load->view('partials/footer') ?>
        </div>
        <!-- end main content-->
