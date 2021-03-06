<?php

use Cake\Error\Debugger;

?>


      <!-- ........................................COPY HERE........................................ -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Incident
            <small> to add, edit, or remove incident</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Incidents</a></li>
            <li class="active">Incidents</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div style="width:200px; float:right; margin-top:10px; margin-bottom:10px; ">
            <button class="btn btn-block btn-success" data-remote="/admin/incident/form?action=add" id="add_incident_btn" data-toggle="modal" data-target="#incident_modal">Add Incident</button>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Incident</h3>
                  <div class="box-tools">
                    <div class="input-group">
                      <input type="text" id="table_search" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <!-- <div class="dataTables_processing">
                    <i class="fa fa-refresh fa-2x fa-spin"></i>
                  </div> -->
                  <table id="incidentTable" class="table table-hover display" width="100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Incident</th>
                        <th>Date/Time</th>
                        <th>Location</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php 
                      $no=1;
                      foreach ($incidents as $i) {               
                          $status = $i->incidentStatus;
                          $i['incidentDateTime']->timezone = 'Asia/Singapore';
                          $incidentDateTime = $i['incidentDateTime']->format('d-m-Y h:i A');
                          $incidentDateTime = str_replace('-', '/', $incidentDateTime);
                          $label = "";
                          switch ($status) {
                             case 'On-going':
                                $label = "success";
                                break;
                             case 'Closed':
                                $label = "danger";
                                break;
                             case 'Pending':
                                $label = "warning";
                                break;
                             default:
                                break;
                          }
                          echo $this->Html->tableCells(
                              array(
                                  $no++,
                                  h($i->incidentTitle),
                                  $incidentDateTime,
                                  h($i->address),
                                  h($i->incidentCategory->incidentCategoryTitle),
                                  "<span class=\"label label-$label\">$i->incidentStatus</span>",
                                  '<a href="#" data-toggle="modal" data-remote="/admin/incident/form?action=edit&id='.$i->incidentID.'" data-target="#incident_modal"> Edit </a> | <a href="/admin/incident/delete?id='.$i->incidentID.'" onclick="deleteItem(event);">Delete</a>'
                              )
                          );
                      }
                    ?>
                  </table>
                </div><!-- /.box-body -->
                <!-- footer pagination -->
                <div id="footer" class="box-footer clearfix">
                </div>
                <!-- /.footer pagination -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="incident_modal" tabindex="-1" role="dialog" aria-labelledby="Incident modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="progress progress-popup">
              <div class="progress-bar progress-bar-striped active" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
 