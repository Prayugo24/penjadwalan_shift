$(document).ready(function(){
  readProducts();//load product
  $(document).on('click','#delete_product',function(e){
      var productId=$(this).data('id');
      SwalDelete(productId);
      e.preventDefault();
  });
});

function SwallDelete(productId){
  swall({
    title:'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    text:"Data Akan di Hapus Secara Permanen !",
    type:'warning',
    showCancelButton:true,
    confirmButtonColor:'#3085d6',
    cancelButtonColor:'#d33',
    confirmButtonText:'Yes, Hapus Data !',
    showLoaderOnConfirm:true,

    preConfirm:function(){
      return new Promise(function(resolve){
        $ajax({
          url:'',
          Type:'POST',
          data:'delete='+productId,
          dataType:'json',
        })
        .done(function(response){
          swal('Deleted!',response.message,response.status);
          readProducts();
        })
        .fail(function(){
          swal('Oops...','Ada data ajax yang salah !','Error');
        });
      });
    },
    allowOutsideClick:false
  });
}

function readProducts(){
  $('#load-products').load('read.php');
}
