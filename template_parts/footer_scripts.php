
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            @2018
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>


    <script src="build/js/custom.min.js"></script>
   <!--  <script src="js/raphael-2.1.4.min.js"></script>
    <script src="js/justgage.js"></script> -->
    
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var gNode1 = document.createElement('div');
        gNode1.setAttribute("class", "gauge");

        var gNode4 = document.createElement('div');
        gNode4.setAttribute("class", "gauge");
        gNode4.setAttribute("data-title", "#4");
        gNode4.setAttribute("data-value", "100");
        gNode4.setAttribute("data-counter", "true");

        /*var gauge1 = new JustGage({
            parentNode: gNode1,
            width: 150,
            height: 150,
            title: "#1",
            value: 2.5,
            min: 0,
            max: 100,
            decimals: 1,
            counter: true
        });*/

     //document.getElementById('g1_show').addEventListener('click', function() {
            /*var container = document.getElementById("cont");
            container.insertBefore(gNode1, container.childNodes[0]);
            container = null;*/
        //});

    });
    </script>