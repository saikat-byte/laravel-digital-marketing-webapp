  <!--   Core JS Files   -->
  <script src="{{ asset('assets/admin/js/core/jquery-3.7.1.min.js') }}"></script>
  <!-- jQuery UI JS using for drag and drop-->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <script src="{{ asset('assets/admin/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>
  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- Success alert --}}
  <script src="{{ asset('assets/admin/js/sweetalert/success_alert.js') }}"></script>
  {{-- Delete alert --}}
  <script src="{{ asset('assets/admin/js/sweetalert/delete_alert.js') }}"></script>

  <!-- Datatables -->
  <script src="{{ asset('assets/admin/js/plugin/datatables/datatables.min.js') }}"></script>
  {{-- Datatable function --}}
  <script src="{{ asset('assets/admin/js/datatables/datatable.js') }}"></script>

  <!-- jQuery Scrollbar -->
  <script src="{{ asset('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
  {{-- Axios --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js" integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

  <!-- Kaiadmin JS -->
  <script src="{{ asset('assets/admin/js/kaiadmin.min.js') }}"></script>
  {{-- toaster --}}
  <!-- Add these just before closing body tag -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
      // Global axios configuration
      axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

      // Toastr configuration
      toastr.options = {
          "closeButton": true
          , "debug": false
          , "newestOnTop": true
          , "progressBar": true
          , "positionClass": "toast-top-right"
          , "preventDuplicates": false
          , "onclick": null
          , "showDuration": "300"
          , "hideDuration": "1000"
          , "timeOut": "5000"
          , "extendedTimeOut": "1000"
          , "showEasing": "swing"
          , "hideEasing": "linear"
          , "showMethod": "fadeIn"
          , "hideMethod": "fadeOut"
          , "toastClass": 'dark-toast'
      }

  </script>
