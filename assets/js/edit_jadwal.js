$(document).ready(function() {
  $('#nama_karyawan').change(function(){
    var nam_kar=$(this).val();
  if (nam_kar=='') {
    $('#tahun').prop('disabled',true);
  }else {
    $('#tahun').prop('disabled',false);
    // ajax
    $('#kd_kar').val( $(this).find('option:selected').data('info') );
    

  }
});
});

$(document).ready(function(){
  $('#tahun').on('change',function(){

    var tahun=$(this).val();
    var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
    if (tahun=='') {
      $('#bulan').prop('disabled',true);
    }else {
      $('#bulan').prop('disabled',false);
      $.ajax({
        url:base_url2+"edit_bulan",
        type:"POST",
        data:{'tahun': tahun},
        dataType:'json',
        success:function(data){
          $('#bulan').html(data);
        },
        error:function(){
          alert('error bulan');
        }

      });
    }
  });
  });

  $(document).ready(function(){
    $('#bulan').on('change',function(){
      var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
      var bulan=$("#bulan").val();
      var tahun=$('#tahun').val();
      var kd_kar=$('#kd_kar').val();

      if (bulan=='') {
        $('#tanggal').prop('disabled',true);
      }else {
        $('#tanggal').prop('disabled',false);
        $.ajax({
          url:base_url2+"edit_tanggal",
          type:"POST",
          data:{'bulan':bulan,
                'tahun':tahun,
                'kd_kar':kd_kar},
          dataType:'json',
          success:function(data){

            $('#tanggal').html(data);
          },
          error:function(data){
            alert('error tanggal'+data);
          }

        });
      }
    });
    });

    $(document).ready(function(){
      $('#tanggal').on('change',function(){

        var bulan=$("#bulan").val();
        var tahun=$('#tahun').val();
        var kd_kar=$('#kd_kar').val();
        var base_url2='/website/kp/codeigneter/index.php/Admin/crud/';
        var tanggal=$(this).val();
        if (tanggal=='') {
          $('#waktu').prop('disabled',true);
        }else {
          $('#waktu').prop('disabled',false);
          $.ajax({
            url:base_url2+"edit_waktu",
            type:"POST",
            data:{'bulan':bulan,
                  'tahun':tahun,
                  'tanggal':tanggal,
                  'kd_kar':kd_kar},
            dataType:'json',
            success:function(data){

              $('#waktu').html(data);
            },
            error:function(data){
              alert('error waktu'+data);
            }

          });
        }
      });
      });
