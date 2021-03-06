      <!-- ........................................COPY HERE........................................ -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Report An Incident
            <small> Submit a incident report of what's happening in your area</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Incidents</a></li>
            <li class="active">Report An Incident</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                  <form role="form" id="add_incident_form" action="/report" method="post">
                    <div class="box-body">
                    <!-- Incident Title -->
                    <div class="form-group">
                        <label>Incident Title</label>
                        <input type="text" class="form-control" name="incidentTitle" id="incident_title_input" placeholder="Enter incident title">
                    </div>

                    <!-- Incident Category -->
                    <div class="form-group">
                        <label>Incident Category</label>
                        <select class="form-control" name="incidentCategoryID" id="incident_category_id">
                          <?php foreach($incident_category_options as $v) {?>
                          <option value=<?='"'. $v['id'] . '"'?>><?=$v['title']?></option>
                          <?php }?>
                        </select>
                    </div>
                    
                    <!-- Details -->
                    <div class="form-group">
                        <label>Details</label>
                        <textarea class="form-control" name="incidentDetails" id="incident_details_input" rows="3" placeholder="Enter details" style="resize:vertical"></textarea>
                    </div>
                    
                    <!-- Address -->
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="incident_location_input" placeholder="Enter the location where the incident happened">
                        <div class="details">
                          <input type="hidden" data-geo="lat" name="latitude"/>
                          <input type="hidden" data-geo="lng" name="longitude"/>
                        </div>
                    </div>
                    
                    <!-- Name of reporter -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="incident_pname_input" name="publicName" placeholder="Enter your name">
                    </div>
                    
                     <!-- Contact of reporter -->
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" class="form-control" id="incident_pcontact_input" name="publicContact" placeholder="Enter your contact number">
                    </div>
                    
                    </div> <!--./box-body-->
                    <div class="box-footer">
                         <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->