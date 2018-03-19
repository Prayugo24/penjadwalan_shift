
$(document).ready(function(){
  $('#thn').on('change',function(){

    var tahun=$(this).val();
    var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
    if (tahun=='') {
      $('#bln').prop('disabled',true);
    }else {
      $('#bln').prop('disabled',false);
      $.ajax({
        url:base_url2+"edit_bulan",
        type:"POST",
        data:{'tahun': tahun},
        dataType:'json',
        success:function(data){
          $('#bln').html(data);
        },
        error:function(){
          alert('error bulan');
        }

      });
    }
  });
  });

  $(document).ready(function(){
    $('#bln').on('change',function(){
      var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
      var bulan=$("#bln").val();
      var tahun=$('#thn').val();


      if (bulan=='') {
        $('#tgl_awl').prop('disabled',true);
        $('#tgl_akhr').prop('disabled',true);
        $('#export_data').prop('disabled',true);
      }else {
        $('#tgl_awl').prop('disabled',false);
        $('#tgl_akhr').prop('disabled',false);
        $('#export_data').prop('disabled',false);
        $.ajax({
          url:base_url2+"cari_waktu_tanggal",
          type:"POST",
          data:{'bulan':bulan,
                'tahun':tahun},
          dataType:'json',
          success:function(data){

            $('#tgl_awl').html(data);
            $('#tgl_akhr').html(data);
          },
          error:function(data){
            alert('error tanggal'+data);
          }

        });
      }
    });
    });
