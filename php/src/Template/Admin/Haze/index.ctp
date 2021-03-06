
      <!-- ........................................COPY HERE........................................ -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Events
            <small> to manage and summarize haze psi readings that are obtained from reliable sources</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Events</a></li>
            <li class="active">Haze</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Haze</h3>
                  <div class="box-tools">
                    <div class="input-group">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>No.</th>
                      <th>Region</th>
                      <th>PSI Value</th>
                      <th>Air Quality Descriptor</th>
                      <th>Date/Time</th>
                    </tr>
                    <?php 
                      $count = 1;
                      foreach ($haze as $i) {               
                          $i['postDateTime']->timezone = 'Asia/Singapore';
                          $time = $i['postDateTime']->format('d-m-Y h:i A');
                          $time = str_replace('-', '/', $time);
                          $label = "";
                          switch ($i->airQualityDescriptor) {
                            case 'Good':
                              $label = "success";
                              break;
                            case 'Moderate':
                              $label = "info";
                              break;
                            case 'Unhealthy':
                            case 'Very unhealthy':
                              $label = "warning";
                              break;
                            case 'Hazardous':
                              $label = "danger";
                              break;
                          }
                          echo $this->Html->tableCells(
                              array(
                                  $count++,
                                  ucfirst($i->region),
                                  $i->psiValue,
                                  "<span class=\"label label-$label\">$i->airQualityDescriptor</span>",
                                  "<div class=\"sparkbar\" data-color=\"#00a65a\" data-height=\"20\">$time</div>"
                              )
                          );
                      }
                    ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <!-- Add PSI Readings - Haze Form -->
    <div class="modal fade" id="addHaze" tabindex="-1" role="dialog" aria-labelledby="addHaze" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="addHaze">Add New Region</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <!-- Region -->
              <div class="form-group">
                  <label>Region</label>
                  <input type="text" class="form-control" id="region_input" placeholder="Enter region in Singapore">
              </div>
              <!-- PSI Value -->
              <div class="form-group">
                  <label>PSI Value</label>
                  <input type="text" class="form-control" id="psi_value_input" placeholder="Enter PSI value of the region">
              </div>
              <!-- Air Quality Descriptor : Good, Moderate, Unhealthy, Hazardous -->
              <div class="form-group">
                 <label>Air Quality Descriptor</label>
                  <select class="form-control" id="severity_input">
                     <option value="good">Good</option>
                     <option value="moderate">Moderate</option>
                     <option value="unhealthy">Unhealthy</option>
                     <option value="hazardous">Hazardous</option>
                  </select>
              </div>
              <!-- Date / Time -->
              <div class="form-group">
                  <label>Date/Time</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" class="form-control" id="datetime_input" placeholder="yyyy-mm-dd HH:mm"/>
                  </div>
              </div>
              <!-- Remarks -->
              <div class="form-group">
                  <label>Remarks</label>
                  <textarea class="form-control" rows="3" placeholder="Enter remarks" style="resize:vertical"></textarea>
              </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>