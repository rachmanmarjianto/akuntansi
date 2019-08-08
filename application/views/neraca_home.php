        <link href="<?php echo base_url('css/datepicker.css');?>" rel="stylesheet">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Neraca</h1>

          <!----- Neraca Saldo ----------->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" >Neraca</h6>
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
                
                <table class="table " >
                  <tbody id="aset">
                    <tr>
                        <td scope="col" colspan="3" style="font-weight:bold; background:#f2f2f2">Aset
                        </td>
                    </tr>
                    
                    <tr>
                      <td width="50%" style="padding-left:40px">Kas</td><td width="25%" style="text-align:right">200.000.000</td><td width="25%" style="text-align:right"></td>
                    </tr>
                  </tbody>
                  <tbody>  
                    <tr>
                      <td colspan="2" style="background-color:#f0fcfb"></td><td style="background-color:#f0fcfb; font-weight:bold; text-align:right" id="totalAset">200.000.000</td>
                    </tr>
                  </tbody>
                  <tbody id="liabilitas">
                    <tr>
                        <td scope="col" colspan="3" style="font-weight:bold; background:#f2f2f2">Liabilitas
                        </td>
                    </tr>
                  </tbody>
                  <tbody id="ekuitas">
                    <tr>
                        <td scope="col" colspan="3" style="font-weight:bold; background:#f2f2f2">Ekuitas
                        </td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr>
                      <td colspan="2" style="background-color:#f0fcfb"></td><td style="background-color:#f0fcfb; font-weight:bold; text-align:right" id="totalLiabilitasEkuitas">200.000.000</td>
                    </tr>
                  </tbody>
                  
                </table>
                  
                

              </div>
          </div>
          <!------ End of Neraca Saldo ------------------>

        </div>
        <!-- /.container-fluid -->


      <script src="<?php echo base_url('js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>


      <script>
        //var jenisAkunName = '{"jenisAkun":[{"id":"4","nama":"pendapatan"}, {"id":"3","nama":"beban"}]}';
        var mydata='{"aset":[{"akun":"kas", "nilai":"100000000"}, {"akun":"piutang usaha", "nilai":"75000000"}, {"akun":"stock", "nilai":"25000000"}],\
                  "liabilitas":[{"akun":"utang usaha", "nilai":"50000000"}],\
                  "ekuitas":[{"akun":"modal", "nilai":"150000000"}],\
                  "totalAset":"200000000",\
                  "totalLiabilitasEkuitas":"200000000"}';

        window.onload=function()
        {
          setTableAkun();
        }
        
        

        function setTableAkun()
        {
          var data = JSON.parse(mydata);

          //=========== aset ======================
          var isiAset='<tr>\
                          <td scope="col" colspan="3" style="font-weight:bold; background:#f2f2f2">Aset\
                          </td>\
                      </tr>';
          for(var i=0; i<data.aset.length; i++)
          {
            isiAset += '\
              <tr>\
                <td width="50%" style="padding-left:40px">'+data.aset[i].akun+'</td>\
                <td width="25%" style="text-align:right">'+numberFormat(data.aset[i].nilai)+'</td>\
                <td width="25%" style="text-align:right"></td>\
              </tr>';
          }
          document.getElementById('aset').innerHTML = isiAset;

          //============== liabilitas ==========================
          var isiLiabilitas='<tr>\
                                <td scope="col" colspan="3" style="font-weight:bold; background:#f2f2f2">Liabilitas\
                                </td>\
                            </tr>';
          for(var i=0; i<data.liabilitas.length; i++)
          {
            isiLiabilitas += '\
              <tr>\
                <td width="50%" style="padding-left:40px">'+data.liabilitas[i].akun+'</td>\
                <td width="25%" style="text-align:right">'+numberFormat(data.liabilitas[i].nilai)+'</td>\
                <td width="25%" style="text-align:right"></td>\
              </tr>';
          }
          document.getElementById('liabilitas').innerHTML = isiLiabilitas;

          //============= ekuitas ==========================
          var isiEkuitas='<tr>\
                              <td scope="col" colspan="3" style="font-weight:bold; background:#f2f2f2">Ekuitas\
                              </td>\
                          </tr>';
          for(var i=0; i<data.ekuitas.length; i++)
          {
            isiEkuitas += '\
              <tr>\
                <td width="50%" style="padding-left:40px">'+data.ekuitas[i].akun+'</td>\
                <td width="25%" style="text-align:right">'+numberFormat(data.ekuitas[i].nilai)+'</td>\
                <td width="25%" style="text-align:right"></td>\
              </tr>';
          }
          document.getElementById('ekuitas').innerHTML = isiEkuitas;

          document.getElementById('totalAset').innerHTML = numberFormat(data.totalAset);
          document.getElementById('totalLiabilitasEkuitas').innerHTML = numberFormat(data.totalLiabilitasEkuitas);


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

