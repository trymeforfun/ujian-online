

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Okky Tirta Kurniawan 2020</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
  <div class="modal-footer">
    <form id="logout-form" action="{{ ('logout') }}" method="POST">
      @csrf
      <button class="btn btn-primary">Logout</button>
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
  </form>
  </div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->

<script src="{{url('/asset/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{url('/asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{url('/asset/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{url('/asset/vendor/chart.js/Chart.min.js')}}"></script>

</body>

</html>