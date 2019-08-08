        <link href="<?php echo base_url('css/datepicker.css');?>" rel="stylesheet">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Laba Rugi</h1>

          <!----- Neraca Saldo ----------->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" >Laba Rugi</h6>
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
                      <th scope="col" style="width:60%; text-align:center; "  >Daftar Akun</th>
                      <th scope="col" style="width:20%; text-align:center"  >Debit</th>
                      <th scope="col" style="width:20%; text-align:center"  >Kredit</th>
                    </tr>
                  </thead>
                  <tbody id="isiTable">
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="text-align:center">Total</th>
                      <th id="totalDebit">0</th>
                      <th id="totalKredit">0</th>
                    </tr>
                    <tr>
                      <th style="text-align:center" id="statusLabaRugi">Laba / Rugi</th>
                      <th colspan="2" style="text-align:right" id="labaRugiBersih">0</th>
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
        //var jenisAkunName = '{"jenisAkun":[{"id":"4","nama":"pendapatan"}, {"id":"3","nama":"beban"}]}';
        var mydata='{"pendapatan":[{"akun":"penjualan", "nilai":"250000000", "letak":"0"}],\
                  "beban":[{"akun":"Beban Gaji", "nilai":"50000000", "letak":"1"}, {"akun":"Beban Bahan Habis Pakai", "nilai":"150000000", "letak":"1"}],\
                  "total":{"debit":"200000000", "kredit":"250000000"},\
                  "labarugi":{"nilai":"50000000", "status":"Laba"}}';

        window.onload=function()
        {
          setTableAkun();
        }
        
        

        function setTableAkun()
        {
          var data = JSON.parse(mydata);
          var isitable = document.getElementById('isiTable');
          var isi = '';

          var keys=Object.keys(data);

          for(var i=0; i<2; i++)
          {
              var str = keys[i];
              isi += '<tr>\
              <td scope="col" colspan="3" style="font-weight:bold; background:#f2f2f2">'+str+'\
                </td>\
              </tr>';

              for(var j=0; j<data[keys[i]].length; j++)
              {
                if(data[keys[i]][j].letak==1)//debit
                {
                  isi +='<tr><td>'+data[keys[i]][j].akun+'</td>\
                        <td>'+numberFormat(data[keys[i]][j].nilai)+'</td>\
                        <td></td></tr>';
                }
                else
                {
                  isi +='<tr><td>'+data[keys[i]][j].akun+'</td>\
                        <td></td>\
                        <td>'+numberFormat(data[keys[i]][j].nilai)+'</td></tr>';
                }
              }
          }

          isitable.innerHTML = isi;

          document.getElementById('totalDebit').innerHTML = numberFormat(data.total.debit);
          document.getElementById('totalKredit').innerHTML = numberFormat(data.total.kredit);
          document.getElementById('labaRugiBersih').innerHTML = numberFormat(data.labarugi.nilai);
          document.getElementById('statusLabaRugi').innerHTML = data.labarugi.status;
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

