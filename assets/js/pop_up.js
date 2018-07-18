function Swall_Input(){
  // untuk alert notifikasi input

}
// untuk alert edit yang berhasil
function Swall_Edit(){


}

function Swall_Delete(productId){
  swal({
    title: 'Anda Yakin Ingin Menghapus Data Ini ?',
    text: "Data Akan Di Hapus Secara Permanen !",
    icon: "warning",

    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Hapus data!',
    showLoaderOnConfirm: true,

    preConfirm: function() {
      return new Promise(function(resolve) {

         $.ajax({
          url: '/kp/codeigneter/index.php/Admin/crud/hapus_pegawai',
          type: 'POST',
            data: 'kd_pegawai='+productId,
            success:function(data){


            },
            error:function(){
                // alert("something went wrong"+datam).console.error();
                swal ( "Oops" ,  "Something went wrong!" ,  "error" )
            }

      });
      },
    allowOutsideClick: false
  });

}

function Swall_gagal(){


}
