
$(document).ready(function(){
  $('#thuun').on('change',function(){

    var tahun=$(this).val();
    var base_url2='/kp/codeigneter/Admin/crud/';
    if (tahun=='') {
      $('#blaan').prop('disabled',true);
    }else {
      $('#blaan').prop('disabled',false);
      $.ajax({
        url:base_url2+"edit_bulan",
        type:"POST",
        data:{'tahun': tahun},
        dataType:'json',
        success:function(data){
          $('#blaan').html(data);
        },
        error:function(){
          alert('error bulan');
        }

      });
    }
  });
  });

  $(document).ready(function(){
    $('#blaan').on('change',function(){
      var base_url2='/kp/codeigneter/Admin/crud/';
      var bulan=$("#blaan").val();
      var tahun=$('#thuun').val();


      if (bulan=='') {
        $('#tgll_awl').prop('disabled',true);
        $('#tgll_akhr').prop('disabled',true);
        $('#export_data').prop('disabled',true);
      }else {
        $('#tgll_awl').prop('disabled',false);
        $('#tgll_akhr').prop('disabled',false);
      //  $('#export_data').prop('disabled',false);
        $.ajax({
          url:base_url2+"cari_waktu_tanggal",
          type:"POST",
          data:{'bulan':bulan,
                'tahun':tahun},
          dataType:'json',
          success:function(data){

            $('#tgll_awl').html(data);
            $('#tgll_akhr').html(data);
          },
          error:function(data){
            alert('error tanggal'+data);
          }

        });
      }
    });
    });
