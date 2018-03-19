$(document).ready(function() {
  $('#nama_kary').change(function(){
    var nam_kar=$(this).val();



  if (nam_kar=='') {
    $('#tahn').prop('disabled',true);
  }else {
    $('#tahn').prop('disabled',false);

        $('#kd_kary').val( $(this).find('option:selected').data('info') );
  }
});
});

$(document).ready(function(){
  $('#tahn').on('change',function(){

    var tahun=$(this).val();
    var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
    if (tahun=='') {
      $('#buln').prop('disabled',true);
    }else {
      $('#buln').prop('disabled',false);
      $.ajax({
        url: base_url2+"edit_bulan",
        type:"POST",
        data:{'tahun': tahun},
        dataType:'json',
        success:function(data){
          $('#buln').html(data);
        },
        error:function(){
          alert('error bulan');
        }

      });
    }
  });
  });

  $(document).ready(function(){
    $('#buln').on('change',function(){

      var bulan=$("#buln").val();
      var tahun=$('#tahn').val();
      var kd_kar=$('#kd_kary').val();
      var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
      if (bulan=='') {
        $('#tanggl').prop('disabled',true);
      }else {
        $('#tanggl').prop('disabled',false);
        $.ajax({
          url:base_url2+"edit_tanggal",
          type:"POST",
          data:{'bulan':bulan,
                'tahun':tahun,
                'kd_kar':kd_kar},
          dataType:'json',
          success:function(data){

            $('#tanggl').html(data);
          },
          error:function(data){
            alert('error tanggl'+data);
          }

        });
      }
    });
    });

    $(document).ready(function(){
      $('#tanggl').on('change',function(){

        var bulan=$("#buln").val();
        var tahun=$('#tahn').val();
        var kd_kar=$('#kd_kary').val();
        var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
        var tanggal=$(this).val();
        if (tanggal=='') {
          $('#wakt').prop('disabled',true);
        }else {
          $('#wakt').prop('disabled',true);
          $.ajax({
            url:base_url2+"edit_waktu",
            type:"POST",
            data:{'bulan':bulan,
                  'tahun':tahun,
                  'tanggal':tanggal,
                  'kd_kar':kd_kar},
            dataType:'json',
            success:function(data){

              $('#wakt').html(data);
            },
            error:function(data){
              alert('error waktu'+data);
            }

          });
        }
      });
      });
