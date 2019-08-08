        <link href="<?php echo base_url('css/datepicker.css');?>" rel="stylesheet">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Neraca Saldo</h1>

          <!----- Neraca Saldo ----------->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" >Neraca Saldo</h6>
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
                      <th scope="col" style="width:25%; text-align:center; padding-bottom:40px"  rowspan="2">Daftar Akun</th>
                      <th scope="col" style="width:25%; text-align:center"  colspan="2">Saldo Awal</th>
                      <th scope="col" style="width:25%; text-align:center"  colspan="2">Pergerakan</th>
                      <th scope="col" style="width:25%; text-align:center"  colspan="2">Saldo Akhir</th>
                    </tr>
                    <tr>
                      <th style="text-align:center">Debit</th>
                      <th style="text-align:center">Kredit</th>
                      <th style="text-align:center">Debit</th>
                      <th style="text-align:center">Kredit</th>
                      <th style="text-align:center">Debit</th>
                      <th style="text-align:center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody id="isiTable">

                  </tbody>
                  <tfoot>
                    <td style="font-weight:bold">Total</td>
                    <td id="saldoAwalTotalDebit" style="font-weight:bold; text-align:right">0</td>
                    <td id="saldoAwalTotalKredit" style="font-weight:bold; text-align:right">0</td>
                    <td id="pergerakanTotalDebit" style="font-weight:bold; text-align:right">0</td>
                    <td id="pergerakanTotalKredit" style="font-weight:bold; text-align:right">0</td>
                    <td id="saldoAkhirTotalDebit" style="font-weight:bold; text-align:right">0</td>
                    <td id="saldoAkhirTotalKredit" style="font-weight:bold; text-align:right">0</td>
                  </tfoot>
                </table>
                  
                

              </div>
          </div>
          <!------ End of Neraca Saldo ------------------>

        </div>
        <!-- /.container-fluid -->


      <script src="<?php echo base_url('js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>


      <script>
        var jenisAkunName = '{"jenisAkun":[{"id":"1", "nama":"aset"},{"id":"2","nama":"liabilitas"},\
                              {"id":"3","nama":"ekuitas"}, {"id":"4","nama":"pendapatan"}, {"id":"5","nama":"beban"}]}';
        
        var myData='{"aset":[{"akun":"Kas", "saldoAwal":{"nilai":"100000000", "letak":"1"}, "pergerakan":{"nilai":"100000000", "letak":"1"}, "saldoAkhir":{"nilai":"200000000", "letak":"1"}},\
                            {"akun":"Bank BCA", "saldoAwal":{"nilai":"30000000", "letak":"1"}, "pergerakan":{"nilai":"50000000", "letak":"1"}, "saldoAkhir":{"nilai":"80000000", "letak":"1"}}],\
                    "liabilitas":[{"akun":"Hutang Usaha", "saldoAwal":{"nilai":"50000000", "letak":"0"}, "pergerakan":{"nilai":"30000000", "letak":"1"}, "saldoAkhir":{"nilai":"20000000", "letak":"0"}}],\
                    "ekuitas":[{"akun":"Modal", "saldoAwal":{"nilai":"500000000", "letak":"0"}, "pergerakan":{"nilai":"300000000", "letak":"0"}, "saldoAkhir":{"nilai":"800000000", "letak":"0"}}],\
                    "pendapatan":[{"akun":"Penjualan", "saldoAwal":{"nilai":"60000000", "letak":"0"}, "pergerakan":{"nilai":"600000000", "letak":"0"}, "saldoAkhir":{"nilai":"660000000", "letak":"0"}}, \
                                  {"akun":"Diskon", "saldoAwal":{"nilai":"0", "letak":"1"}, "pergerakan":{"nilai":"30000000", "letak":"1"}, "saldoAkhir":{"nilai":"30000000", "letak":"1"}}],\
                    "beban":[{"akun":"Beban Stock", "saldoAwal":{"nilai":"0", "letak":"1"}, "pergerakan":{"nilai":"500000000", "letak":"1"}, "saldoAkhir":{"nilai":"500000000", "letak":"1"}}],\
                    "total":{"saldoAwal":{"debit":"100000000","kredit":"100000000"}, "pergerakan":{"debit":"200000000", "kredit":"200000000"}, "saldoAkhir":{"debit":"300000000", "kredit":"300000000"}}\
                    }';

        window.onload=function()
        {
          setTableAkun();
        }
        
        

        function setTableAkun()
        {
          var data = JSON.parse(myData);
          var isitable = document.getElementById('isiTable');
          var isi = '';
          var keys=Object.keys(data);

          for(var i=0; i<5; i++)
          {
              var str = keys[i];
              isi += '<tr>\
              <td scope="col" colspan="7" style="font-weight:bold; background:#f2f2f2">'+str+'\
                </td>\
              </tr>\
              <div id="isi'+str+'"></div>';

              for(var j=0; j<data[keys[i]].length; j++)
              {
                isi += '<tr>\
                  <td>'+data[keys[i]][j].akun+'</td>';
                
                //saldo awal
                if(data[keys[i]][j].saldoAwal.letak==1)
                {
                  isi += '\
                  <td style="text-align:right">'+numberFormat(data[keys[i]][j].saldoAwal.nilai)+'</td>\
                  <td style="text-align:right">0</td>';
                }
                else
                {
                  isi += '\
                  <td style="text-align:right">0</td>\
                  <td style="text-align:right">'+numberFormat(data[keys[i]][j].saldoAwal.nilai)+'</td>';
                }

                //pergerakan
                if(data[keys[i]][j].pergerakan.letak==1)
                {
                  isi += '\
                  <td style="text-align:right">'+numberFormat(data[keys[i]][j].pergerakan.nilai)+'</td>\
                  <td style="text-align:right">0</td>';
                }
                else
                {
                  isi += '\
                  <td style="text-align:right">0</td>\
                  <td style="text-align:right">'+numberFormat(data[keys[i]][j].pergerakan.nilai)+'</td>';
                }

                //saldo akhir
                if(data[keys[i]][j].saldoAkhir.letak==1)
                {
                  isi += '\
                  <td style="text-align:right">'+numberFormat(data[keys[i]][j].saldoAkhir.nilai)+'</td>\
                  <td style="text-align:right">0</td>';
                }
                else
                {
                  isi += '\
                  <td style="text-align:right">0</td>\
                  <td style="text-align:right">'+numberFormat(data[keys[i]][j].saldoAkhir.nilai)+'</td>';
                }
              }
          }

          isitable.innerHTML = isi;

          document.getElementById('saldoAwalTotalDebit').innerHTML=numberFormat(data.total.saldoAwal.debit);
          document.getElementById('saldoAwalTotalKredit').innerHTML=numberFormat(data.total.saldoAwal.kredit);
          document.getElementById('pergerakanTotalDebit').innerHTML=numberFormat(data.total.pergerakan.debit);
          document.getElementById('pergerakanTotalKredit').innerHTML=numberFormat(data.total.pergerakan.kredit);
          document.getElementById('saldoAkhirTotalDebit').innerHTML=numberFormat(data.total.saldoAkhir.debit);
          document.getElementById('saldoAkhirTotalKredit').innerHTML=numberFormat(data.total.saldoAkhir.kredit);
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

