
$(document).ready(function(){
  $('#thn').on('change',function(){

    var tahun=$(this).val();
    var base_url2='/kp/codeigneter/Admin/crud/';
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
      var base_url2='/kp/codeigneter/Admin/crud/';
      var bulan=$("#bln").val();
      var tahun=$('#thn').val();


      if (bulan=='') {
        $('#tagl_awll').prop('disabled',true);
        $('#tagl_akhrr').prop('disabled',true);
        $('#export_data').prop('disabled',true);
      }else {
        $('#tagl_awll').prop('disabled',false);
        $('#tagl_akhrr').prop('disabled',false);
      //  $('#export_data').prop('disabled',false);
        $.ajax({
          url:base_url2+"cari_waktu_tanggal",
          type:"POST",
          data:{'bulan':bulan,
                'tahun':tahun},
          dataType:'json',
          success:function(data){

            $('#tagl_awll').html(data);
            $('#tagl_akhrr').html(data);
          },
          error:function(data){
            alert('error tanggal'+data);
          }

        });
      }
    });
    });
