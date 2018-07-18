function Swall_DeleteJad(kd_kar){
//  var kd_kary=kd_kar;
  // alert('error hapus'+kd_kary);

  var base_url2='/kp/codeigneter/index.php/Admin/crud/';
swal({
  title: "Anda Yakin?",
  text: "Data Yang Sudah Terhapus Tidak Bisa Dikembalikan Lagi!",
  icon: "warning",
  buttons: true,
  dangerMode: true,

})
.then((willDelete) => {
  if (willDelete) {
      $.ajax({
        url:base_url2+"hapus_jadwal_2",
        type:"POST",
        data:{'kd_kary':kd_kar},

        success:function(){
          swal("Terhapus!", "Data Berhasil Dihapus.", {
            icon: "success",
          });
          window.location.reload();
        },
        error:function(){
          alert('error hapus');
        }

      });

  } else {
    swal("Cancelled", "Data Tidak Jadi Dihapus");
  }
});
}

function _Deletejadwal(){
  kd_kar="00";
    var base_url2='/kp/codeigneter/index.php/Admin/crud/';
  swal({
    title: "Anda Yakin?",
    text: "Data Yang Sudah Terhapus Tidak Bisa Dikembalikan Lagi!",
    icon: "warning",
    buttons: true,
    dangerMode: true,

  })
  .then((willDelete) => {
    if (willDelete) {
        $.ajax({
          url:base_url2+"hapus_jadwal",
          type:"POST",
          data:{'kd_kary':kd_kar},

          success:function(){
            swal("Terhapus!", "Data Berhasil Dihapus.", {
              icon: "success",
            });
            window.location.reload();
          },
          error:function(){
            alert('error hapus');
          }

        });

    } else {
      swal("Cancelled", "Data Tidak Jadi Dihapus");
    }
  });
}
