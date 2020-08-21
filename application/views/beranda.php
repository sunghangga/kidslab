<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="register_count"></h3>

                <p>Register</p>
              </div>
              <div class="icon">
                <i class="fas fa-list-ol"></i>
              </div>
              <a href="<?php echo base_url('register') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="payment_count"></h3>

                <p>Payment</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-check-alt"></i>
              </div>
              <a href="<?php echo base_url('payment') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="shipment_count"></h3>

                <p>Shipment</p>
              </div>
              <div class="icon">
                <i class="fas fa-shipping-fast"></i>
              </div>
              <a href="<?php echo base_url('shipment') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="schedule_count"></h3>

                <p>Schedule</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <a href="<?php echo base_url('register/schedule') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="classroom_count"></h3>

                <p>Online Class</p>
              </div>
              <div class="icon">
                <i class="fas fa-university"></i>
              </div>
              <a href="<?php echo base_url('classroom') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="participants_count"></h3>

                <p>Participants</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?php echo base_url('participants') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
    </div>
    <!-- /.content -->
  </section>
  <script src="<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $.ajax({
          type : 'ajax',
          url : '<?php echo base_url()?>beranda/get_count/',
          // async : false,
          dataType : 'json',
          success : function(data){
            document.getElementById("register_count").innerHTML = data.register;
            document.getElementById("payment_count").innerHTML = data.payment;
            document.getElementById("shipment_count").innerHTML = data.shipment;
            document.getElementById("schedule_count").innerHTML = data.payment;
            document.getElementById("classroom_count").innerHTML = data.classroom;
            document.getElementById("participants_count").innerHTML = data.participants;
          }
      });
    });
  </script>