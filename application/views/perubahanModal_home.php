        <link href="<?php echo base_url('css/datepicker.css');?>" rel="stylesheet">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Perubahan Modal</h1>

          <!----- Neraca Saldo ----------->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" >Perubahan Modal</h6>
              </div>
              <div class="card-body">
                <div class="row" style="padding-bottom:10px">
                  <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-5" style="position: relative; top:0.5em; text-align:right">
                          Pilih Bulan :
                        </div>

                        <div class="col-lg-7">
                          <input class="form-control datepicker" id="datepicker1" width="50px" style="display:inline"/>
                        </div>
                       
                    </div>
                  </div>

                  <div class="col-lg-8" style="text-align:left">
                    <button class="btn btn-success" style="width:100px">
                      <span class="text">
                        Submit
                      </span>
                    </button>
                  </div>

                </div>
                
                <table class="table table-bordered" >
                  <thead>
                    <tr>
                      <th scope="col" style="width:60%; text-align:center;"  >Daftar Akun</th>
                      <th scope="col" style="width:20%; text-align:center"  >Debit</th>
                      <th scope="col" style="width:20%; text-align:center"  >Kredit</th>
                    </tr>
                  </thead>
                  <tbody id="isiTable">
                  </tbody>
                  <tfoot>
                    <tr style="border-top: 2px solid black">
                      <th style="text-align:center">Modal Akhir</th>
                      <th colspan="2" style="text-align:right" id="modalAkhir">0</th>
                    </tr>
                  </tfoot>
                </table>
                  
                

              </div>
          </div>
          <!------ End of Neraca Saldo ------------------>

        </div>
        <!-- /.container-fluid -->


      <script src="<?php echo base_url('js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>


      <script>
        var dataPerubahanModal = '{"isiTable":[{"akun":"modal", "nilai":"200000000", "letak":"0"}, {"akun":"Laba Bersih", "nilai":"50000000", "letak":"0"},\
                        {"akun":"prive", "nilai":"10000000", "letak":"1"}], "modalAkhir":{"nilai":"240000000", "letak":"0"}}';

        window.onload=function()
        {
          setTableAkun();
        }
        
        

        function setTableAkun()
        {
          var data = JSON.parse(dataPerubahanModal);
          var isitable = document.getElementById('isiTable');
          var isi = '';

          for(var i=0; i<data.isiTable.length; i++)
          {
              var akun = data.isiTable[i].akun;
              var nilai = numberFormat(data.isiTable[i].nilai);
              var letak = data.isiTable[i].letak;

              numberFormat(nilai);

              isi +='<tr>\
              <td>'+akun+'</td>';

              if(letak==1)//debit
              {
                isi += '<td>'+nilai+'</td>\
                      <td></td>\
                      </tr>';
              }
              else
              {
                isi += '<td></td>\
                      <td>'+nilai+'</td>\
                      </tr>';
              }
          }

          isitable.innerHTML = isi;

          document.getElementById('modalAkhir').innerHTML = numberFormat(data.modalAkhir.nilai);
        }

        function numberFormat(num)
        {
          var arr=num.split("");
          var len= arr.length;
          var x = len%3;
          if(x==0)
            len--;
          var dot = parseInt(len/3);
          var result=[];
          var j=0;
          var z=0;
          for(var i=arr.length; i>=0; i--)
          {
            result[j]=arr[i];
            if(z>=3 && arr[i]==0)
            {
              j++;
              result[j]='.';
              j++;
              z=1;
              continue;
            }
            z++;
            j++;
          }

          return result.reverse().join('');
        }

        

        $('.datepicker').datepicker({
              format: 'mm yyyy',
              viewMode: 'months',
          }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
          });

      </script>

