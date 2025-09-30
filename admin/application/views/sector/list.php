        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php $this->load->view('partials/page-title', array('pagetitle'=>'Home','title'=>'Sector')); ?>
                    <?php
                        add_edit_form();
                    ?>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">Sectors</h5>
                                    <div>
                                        <button id="addRow" class="btn btn-primary open_my_form_form" data-control="sector"><i class="ri-add-fill me-1 align-bottom"></i>Add Sector</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle common_datatable" data-control="sector" data-mathod="manage" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sector Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
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
