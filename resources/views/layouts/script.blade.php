 <script src="{{ asset('backend/js/vendors.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/app.bundle.js') }}"></script>
 <script type="text/javascript">
     $('#js-page-content').smartPanel();
 </script>

 <script>
     'use strict';
     var classHolder = document.getElementsByTagName("BODY")[0],
         /**
          * Load from localstorage
          **/
         themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
         {},
         themeURL = themeSettings.themeURL || '',
         themeOptions = themeSettings.themeOptions || '';
     /**
      * Load theme options
      **/
     if (themeSettings.themeOptions) {
         classHolder.className = themeSettings.themeOptions;
         // console.log("%c✔ Theme settings loaded", "color: #148f32");
     } else {
         // console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
     }
     if (themeSettings.themeURL && !document.getElementById('mytheme')) {
         var cssfile = document.createElement('link');
         cssfile.id = 'mytheme';
         cssfile.rel = 'stylesheet';
         cssfile.href = themeURL;
         document.getElementsByTagName('head')[0].appendChild(cssfile);
     }
     /**
      * Save to localstorage
      **/
     var saveSettings = function() {
         themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
             return /^(nav|header|mod|display)-/i.test(item);
         }).join(' ');
         if (document.getElementById('mytheme')) {
             themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
         };
         localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
     }
     /**
      * Reset settings
      **/
     var resetSettings = function() {
         localStorage.setItem("themeSettings", "");
     }
 </script>
 <script src="{{ asset('backend/js/dependency/moment/moment.js') }}"></script>
 <script src="{{ asset('backend/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/statistics/sparkline/sparkline.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/statistics/easypiechart/easypiechart.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/statistics/flot/flot.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/miscellaneous/jqvmap/jqvmap.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/datagrid/datatables/datatables.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/datagrid/datatables/datatables.export.js') }}"></script>
 <script src="{{ asset('backend/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
 <script src="{{ asset('backend/js/formplugins/select2/select2.bundle.js')}}"></script>
 <script src="{{ asset('js/custom-js.js') }}"></script>
 <script src="{{ asset('js/form-validation-by-sc.js') }}"></script>
 <script src="{{ asset('backend/js/notifications/toastr/toastr.js')}}"></script>

