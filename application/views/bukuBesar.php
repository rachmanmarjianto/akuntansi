        <link href="<?php echo base_url('css/bootstrap-select.min.css');?>" rel="stylesheet">
        <script src="<?php echo base_url('js/bootstrap-select.min.js');?>"></script>
        <link href="<?php echo base_url('css/datepicker.css');?>" rel="stylesheet">

        <style>
          .colStyle{
            text-align:center;
            vertical-align:middle;
            line-height:90px;
          }
        </style>


        <!-- Begin Page Content -->
        <div class="container-fluid">
          <h1 class="h3 mb-4 text-gray-800">Buku Besar</h1>
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tampilkan Buku Besar</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <p class="h6 text-center text-primary">Jenis Akun</p>
                  </div>
                  <div class="col-md-6">
                    <p class="h6 text-center text-primary">Nama Akun</p>
                  </div>
                  <div class="col-md-3">
                    <p class="h6 text-center text-primary"></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <select class="custom-select" id="pilihJenisAkun" size="3" onchange="standarPenambahan(this)">
                      <option value="aset" selected="">Aset</option>
                      <option value="liabilitas">Liabilitas</option>
                      <option value="ekuitas">Ekuitas</option>
                    </select>
                  </div>

                  <div class="col-md-6" style="margin-top:20px">
                    <select class="selectpicker" data-live-search="true" id="namaAkun">
                      
                    </select>
                  </div>


                  <div class="col-md-3 text-center">
                    <button class="btn btn-success" onclick="tampil()" style="margin-top:20px; width:150px">
                      <span class="text">
                        Tampilkan
                      </span>
                    </button>
                  </div>
                </div>
                
              </div>
          </div>

          <div id="tabelBukuBesar">
            
          </div>

        </div>
        <!-- /.container-fluid -->

        <script src="<?php echo base_url('js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>

        <script>
          var detailAkun='{"aset":[{"id":"11","akun":"Kas"}, {"id":"12", "akun":"Piutang Usaha"}, {"id":"14", "akun":"Bahan Habis Pakai"}, {"id":"15", "akun":"Stock"}, {"id":"17", "akun":"Tanah"}],\
                            "liabilitas":[{"id":"21", "akun":"Utang Usaha"},{"id":"23", "akun":"Sewa Diterima Di Muka"}],\
                            "ekuitas":[{"id":"31", "akun":"Modal"}, {"id":"32", "akun":"Prive"}],\
                            "pendapatan":[{"id":"41", "akun":"Penjualan"}],\
                            "beban":[{"id":"51","akun":"Beban Gaji"}]}';
          
          var shownTables = new Array();
          
          window.onload=function(){
              setJenisAkunReady();
              var selEl = document.getElementById('pilihJenisAkun');
              standarPenambahan(selEl);
            }

          function setJenisAkunReady()
          {
            var sel = document.getElementById('pilihJenisAkun');

            var data = JSON.parse(detailAkun);
            var keys = Object.keys(data);

            var opsi='';
            for(var i=0; i<keys.length; i++)
            {
              opsi += '<option value="'+keys[i]+'" selected="">'+keys[i].charAt(0).toUpperCase()+keys[i].slice(1)+'</option>'
            }

            sel.innerHTML = opsi;
          }

          function standarPenambahan(curEl)
          {
            var data = JSON.parse(detailAkun);

            var akun=curEl.options[curEl.selectedIndex].value;

            var elSelect = document.getElementById('namaAkun');
            removeOptions(elSelect);

            for(var i=0; i<data[akun].length; i++)
            {
              var option = document.createElement("option");
              option.text = data[akun][i].akun;
              option.value= data[akun][i].id;
              
              elSelect.add(option);
              
              // console.log(data.aset[i].id+' isinya '+data.aset[i].akun);
            }
/*
            switch(akun)
            {
              case 'aset': 
                  for(var i=0; i<data.aset.length; i++)
                  {
                    var option = document.createElement("option");
                    option.text = data.aset[i].akun;
                    option.value= data.aset[i].id;
                    
                    elSelect.add(option);
                    
                   // console.log(data.aset[i].id+' isinya '+data.aset[i].akun);
                  }
                  break;
              case 'liabilitas': 
                  for(var i=0; i<data.liabilitas.length; i++)
                  {
                    var option = document.createElement("option");
                    option.text = data.liabilitas[i].akun;
                    option.value= data.liabilitas[i].id;
                    
                    elSelect.add(option);
                    
                   // console.log(data.liabilitas[i].id+' isinya '+data.liabilitas[i].akun);
                  }
                  break;
              case 'ekuitas': 
                  for(var i=0; i<data.ekuitas.length; i++)
                  {
                    var option = document.createElement("option");
                    option.text = data.ekuitas[i].akun;
                    option.value= data.ekuitas[i].id;
                    
                    elSelect.add(option);
                    
                   // console.log(data.ekuitas[i].id+' isinya '+data.ekuitas[i].akun);
                  }
                  break;
            }
*/
            $('#namaAkun').selectpicker('refresh');
          }

          function removeOptions(selectbox)
          {
              var i;
              for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
              {
                  selectbox.remove(i);
              }
          }

          

          function tampil()
          {
            var akun = document.getElementById('namaAkun');
            var akunId = akun.options[akun.selectedIndex].value;
            var namaAkun = akun.options[akun.selectedIndex].innerHTML;

            var jenisAkun = document.getElementById('pilihJenisAkun');
            var jenisAkunVal = jenisAkun.options[jenisAkun.selectedIndex].value;

            //alert(akunId+' '+namaAkun+' '+jenisAkunVal);
            var space=document.getElementById('tabelAset');

            
          }

          function del(idTabel,id)
          {
            document.getElementById(idTabel).remove();
            var foundID= shownTables.indexOf(id);
            
            if(foundID != -1)
            {
              shownTables.splice(foundID,1);  
            }
          }

          function tampil()
          {
            var akun = document.getElementById('namaAkun');
            var akunId = akun.options[akun.selectedIndex].value;
            var namaAkun = akun.options[akun.selectedIndex].innerHTML;

            var jenisAkun = document.getElementById('pilihJenisAkun');
            var jenisAkunVal = jenisAkun.options[jenisAkun.selectedIndex].value;

            var found = shownTables.indexOf(akunId);
            if(found != -1)
            {
              alert('Tabel '+namaAkun+' telah ditampilkan');
              return;
            }
            else
            {
              shownTables[shownTables.length]=akunId;
            }
            

            //alert(jenisAkunVal+' '+akunId+' '+namaAkun);

            var tabel = '\
            <div class="card shadow mb-4" id="tabel'+namaAkun+'">\
              <div class="card-header py-3">\
                <div class="row">\
                  <div class="col-lg-11">\
                      <h6 class="m-0 font-weight-bold text-primary">'+jenisAkunVal.toUpperCase()+' - '+namaAkun+'</h6>\
                    </div>\
                    <div class="col-lg-1" style="text-align:right; cursor:pointer">\
                      <i class="fa fa-window-close" aria-hidden="true" style="color:red" onclick="del(\'tabel'+namaAkun+'\', \''+akunId+'\')"></i>\
                    </div>\
                </div>\
              </div>\
              <div class="card-body">\
                  <div class="row" style="padding-bottom:10px">\
                    <div class="col-lg-4">\
                      <div class="row">\
                          <div class="col-lg-5" style="position: relative; top:0.5em; text-align:right">\
                            Tanggal Awal :\
                          </div>\
                          <div class="col-lg-7">\
                            <input class="form-control datepicker" id="tanggalAwal'+namaAkun+'" width="50px" style="display:inline"/>\
                          </div>\
                      </div>\
                    </div>\
                    <div class="col-lg-4">\
                      <div class="row">\
                          <div class="col-lg-5" style="position: relative; top:0.5em; text-align:right">\
                            Tanggal Akhir :\
                          </div>\
                          <div class="col-lg-7">\
                            <input class="form-control datepicker" id="tanggalAkhir'+namaAkun+'" width="50px" style="display:inline"/>\
                          </div>\
                      </div>\
                    </div>\
                    <div class="col-lg-4" style="text-align:center">\
                      <button class="btn btn-success" style="width:100px" onclick="getData(\''+akunId+'\', \''+namaAkun+'\')">\
                        <span class="text">\
                          Submit\
                        </span>\
                      </button>\
                    </div>\
                  </div>\
                  <table class="table table-bordered" >\
                    <thead>\
                      <tr>\
                        <th scope="col" class="colStyle" style="width:10%; text-align:center" rowspan="2">Tanggal</th>\
                        <th scope="col" class="colStyle" style="width:38%; text-align:center" rowspan="2">Keterangan</th>\
                        <th scope="col" class="colStyle" style="width:13%; text-align:center" rowspan="2">Debit</th>\
                        <th scope="col" class="colStyle" style="width:13%; text-align:center" rowspan="2">Kredit</th>\
                        <th scope="col" style="width:13%; text-align:center" colspan="2">Saldo</th>\
                      </tr>\
                      <tr>\
                        <th scope="col" style="width:13%; text-align:center">Debit</th>\
                        <th scope="col" style="width:13%; text-align:center">Kredit</th>\
                      </tr>\
                    </thead>\
                    <tbody id="isi'+namaAkun+'">\
                    </tbody>\
                  </table>\
                </div>\
            </div>';

            

            var spaceBukuBesar=document.getElementById('tabelBukuBesar');

            spaceBukuBesar.innerHTML += '<br>'+tabel;

            $('.datepicker').datepicker({
              format: 'dd/mm/yyyy',
              autoclose: true
            }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
          }

          function getData(akunID, akunName)
          {
            var idTanggalAwal = 'tanggalAwal'+akunName;
            var idTanggalAkhir = 'tanggalAkhir'+akunName;

            var taw = document.getElementById(idTanggalAwal).value;
            var tak = document.getElementById(idTanggalAkhir).value;

            console.log(akunID+' '+akunName+' '+taw+' '+tak);
          }

        </script>

