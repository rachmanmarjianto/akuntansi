        <!-- Custom styles for this page -->
        <link href="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Akun</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <p class="h6 text-center text-primary">Jenis Akun</p>
                </div>
                <div class="col-md-6">
                  <p class="h6 text-center text-primary">Nama Akun Baru</p>
                </div>
                <div class="col-md-3">
                  <p class="h6 text-center text-primary">Bertambah Dengan</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                <select class="custom-select" id="pilihJenisAkun" size="2" onchange="standarPenambahan(this)">
                  <option value="aset" selected>Aset</option>
                  <option value="liabilitas">Liabilitas</option>
                  <option value="ekuitas">Ekuitas</option>
                  <option value="pendapatan">Pendapatan</option>
                  <option value="beban">Beban</option>
                </select>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="tambahAkun" aria-describedby="emailHelp" placeholder="Nama Akun ">
                </div>
                <div class="col-md-3 text-center">
                  <select class="custom-select" size="2" id="akunTambahDengan">
                    <option value="1" selected>Debet</option>
                    <option value="0">Kredit</option>
                  </select>
                </div>
              </div>
              <div class="row" style="margin-top:20px">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                  <button class="btn btn-success" onclick="tambahAkun()">
                    <span class="text">
                      Tambahkan
                    </span>
                  </button>
                </div>

              </div>
            </div>
          </div>

          <!--- table-table akun ---->

          <div id="akunTable">

            

          </div>
          <!-- end of table-table -->

         

        </div>
        <!-- /.container-fluid -->

        <script>

        /*  var jenisAkunName = '{"jenisAkun":[{"id":"1", "nama":"aset"},{"id":"2","nama":"liabilitas"}, {"id":"3","nama":"ekuitas"}, {"id":"4","nama":"pendapatan"}, {"id":"5","nama":"beban"}]}';
          var isiTable = '{"aset":[{"namaAkun":"Kas", "tambahDengan":"1","aktiv":"1"},{"namaAkun":"Piutang", "tambahDengan":"1","aktiv":"1"}],\
                            "liabilitas":[{"namaAkun":"Hutang Gaji", "tambahDengan":"0","aktiv":"1"}],\
                            "ekuitas":[{"namaAkun":"Modal", "tambahDengan":"0", "aktiv":"1"}, {"namaAkun":"Laba Ditahan", "tambahDengan":"0", "aktiv":"0"}],\
                            "pendapatan":[{"namaAkun":"Penjualan", "tambahDengan":"0", "aktiv":"1"}],\
                            "beban":[{"namaAkun":"Iklan", "tambahDengan":"1", "aktiv":"1"}, {"namaAkun":"Upah", "tambahDengan":"1", "aktiv":"0"}]}';
        */

          var jenisAkunName = <?php echo "'".$jenisAkun."'";?>;
          var isiTable = <?php echo "'".$namaAkun."'";?>;

          window.onload=function(){
            setTableReady();
            setIsiTable();
          }

          function ubahLetak(elemen, id)
          {
            var tipe = elemen.childNodes[1].id;

            var parent = elemen.parentNode.id;
            var n = parent.indexOf("_");
            
            var akun = parent.substr(0,n);
           // alert(akun);

            var m = parent.lastIndexOf("_");

            //alert(parent.length+' '+m);

            n++;
            var x = m-n;
            
            var parentType = parent.substr(n,x);
            //alert(parentType);
            var neigh='';
            if(parentType=='tambah')
              neigh=akun+'_kurang_'+id;
            else
              neigh=akun+'_tambah_'+id;

            /* 
              Tambahkan ajax disini yang melakukan update ke database!!
              respon ajax jika sukses adalah perubahan letak debet kredit.
              respon ajax jika gagal adalah notifikasi atau alert dengan pesan error!
            */

            if(tipe=='debet')
            {
              var curEl = document.getElementById(parent);
              curEl.innerHTML = '<button class="btn btn-warning btn-icon-split" onclick="ubahLetak(this, '+id+')">\
                                  <span class="text" id="kredit">Kredit</span>\
                                </button>';
                                
              var curNeigh = document.getElementById(neigh);
              curNeigh.innerHTML = '<button class="btn btn-success btn-icon-split" onclick="ubahLetak(this, '+id+')">\
                                  <span class="text" id="debet">Debet</span>\
                                </button>';
              
            }
            else
            {
              var curEl = document.getElementById(parent);
              curEl.innerHTML = '<button class="btn btn-success btn-icon-split" onclick="ubahLetak(this, '+id+')">\
                                  <span class="text" id="debet">Debet</span>\
                                </button>';
                                
              var curNeigh = document.getElementById(neigh);
              curNeigh.innerHTML = '<button class="btn btn-warning btn-icon-split" onclick="ubahLetak(this, '+id+')">\
                                  <span class="text" id="kredit">Kredit</span>\
                                </button>';
              
            }

            

          }


          function standarPenambahan(curEl)
          {
            var akun=curEl.options[curEl.selectedIndex].value;

            switch(akun)
            {
              case 'aset': 
                  document.getElementById('akunTambahDengan').selectedIndex = 0;
                  break;
              case 'liabilitas': 
                  document.getElementById('akunTambahDengan').selectedIndex = 1;
                  break;
              case 'equitas': 
                  document.getElementById('akunTambahDengan').selectedIndex = 1;
                  break;
              case 'pendapatan': 
                  document.getElementById('akunTambahDengan').selectedIndex = 1;
                  break;
              case 'beban': 
                  document.getElementById('akunTambahDengan').selectedIndex = 0;
                  break;
              

            }
          }

          function activate(checkbox)
          {

            var namaAkun = checkbox.parentNode.parentNode.childNodes[0].innerHTML;
            var curstatus =0;
            if(checkbox.checked)
            {
              curstatus = 1;
            }
            

            url = 'C_pengaturan/activateAkun';
 
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
              //jika berhasil
              if(this.readyState==4 && this.status == 200)
              {
              //  if(this.responseText==0)
              //    tambahIsiTable(akun, tambahDengan, jenisAkun, 1);  
               // console.log(this.responseText);
                if(this.responseText == 0)
                {
                  if(checkbox.checked)
                  {
                    checkbox.value=1;
                  }
                  else
                  {
                    checkbox.value=0;
                  }
                }
                
              }
              
            }

            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("namaAkun="+namaAkun+"&curstatus="+curstatus);
            
            
            

            //gunakan ajax untuk update status, jika success ubah nilai dan status checked
            
          }

          function setIsiTable()
          {
            var data = JSON.parse(isiTable);
            var keys = Object.keys(data);
            
            for(var i=0; i<keys.length; i++)
            {
              var jenisAkun = keys[i];  
              for(var j=0; j<data[jenisAkun].length; j++)
              {
                var akun = data[jenisAkun][j].namaAkun;
                var tambahDengan = data[jenisAkun][j].tambahDengan;
                var aktiv = data[jenisAkun][j].aktiv;

                tambahIsiTable(akun, tambahDengan, jenisAkun, aktiv);
              }              
            }
          }

          function setTableReady()
          {
            var jenisAkun = JSON.parse(jenisAkunName);

            var spaceTable = document.getElementById('akunTable');


            for(var i=0; i<jenisAkun.jenisAkun.length; i++)
            {
              var str = jenisAkun.jenisAkun[i].nama;
              var strFirstLaterUpper = str.charAt(0).toUpperCase()+str.slice(1);

              //------ setup table ------------
              var curTable = '\
              <div class="card shadow mb-4">\
              <div class="card-header py-3">\
                <h6 class="m-0 font-weight-bold text-primary">'+str+'</h6>\
              </div>\
              <div class="card-body">\
                <div class="table-responsive">\
                  <table class="table table-bordered" id="table'+strFirstLaterUpper+'" width="100%" cellspacing="0">\
                    <thead>\
                      <tr>\
                        <th width="68%">Nama Akun</th>\
                        <th width="12%">Tambah</th>\
                        <th width="12%">Kurang</th>\
                        <th width="8%">Aktiv</th>\
                      </tr>\
                    </thead>\
                    <tbody id="isiTable'+strFirstLaterUpper+'">\
                      <tr style="display:none">\
                        <td></td>\
                        <td></td>\
                        <td></td>\
                        <td></td>\
                      </tr>\
                    </tbody>\
                  </table>\
                </div>\
              </div>\
            </div>';

            spaceTable.innerHTML += curTable;  

            }
          }


          function tambahAkun()
          {
            var akun = document.getElementById('tambahAkun').value;

            if(akun=='')
            {
              alert('Nama Akun Belum Diisi');
              return false;
            }

            var jA = document.getElementById('pilihJenisAkun');
            var jenisAkun = jA.options[jA.selectedIndex].value;

            

            var tD = document.getElementById('akunTambahDengan');
            var tambahDengan = tD.options[tD.selectedIndex].value;

            url = 'C_pengaturan/tambahakun';
 
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
              //jika berhasil
              if(this.readyState==4 && this.status == 200)
              {
                if(this.responseText==0)
                  tambahIsiTable(akun, tambahDengan, jenisAkun, 1);  
              }
              
            }

            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("akun="+akun+"&jenisAkun="+jenisAkun+"&tambahDengan="+tambahDengan);

            
            
          }

          
          function tambahIsiTable(akun, tambahDengan, jenisAkun, aktiv)
          {
            var idTable='table'+jenisAkun.charAt(0).toUpperCase()+jenisAkun.slice(1);
            var idIsiTable='isiTable'+jenisAkun.charAt(0).toUpperCase()+jenisAkun.slice(1);
 
            var table = document.getElementById(idTable);
            var rownum = table.rows.length;
            var isiTable = document.getElementById(idIsiTable);
            var curIsi = isiTable.innerHTML;
            //console.log(idTable);

            var addRowTable = $('#'+idTable).DataTable();

            var colAktiv='';
            if(aktiv==1)
            {
              colAktiv = '<input type="checkbox" value="1" checked onclick="activate(this)">';
            }
            else
            {
              colAktiv = '<input type="checkbox" value="0" onclick="activate(this)">';
            }

            if(tambahDengan==1)
            {
              addRowTable.row.add([
                akun,
                '<div id="'+jenisAkun+'_tambah_'+rownum+'">\
                    <button class="btn btn-success btn-icon-split" onclick="ubahLetak(this, '+rownum+')">\
                      <span class="text" id="debet">Debet</span>\
                    </button>\
                  </div>',
                '<div id="'+jenisAkun+'_kurang_'+rownum+'">\
                    <button class="btn btn-warning btn-icon-split" onclick="ubahLetak(this, '+rownum+')">\
                      <span class="text" id="kredit">Kredit</span>\
                    </button>\
                  </div>',
                colAktiv

              ]).draw();
                        
            }
            else
            {
              addRowTable.row.add([
                akun,
                '<div id="'+jenisAkun+'_kurang_'+rownum+'">\
                    <button class="btn btn-warning btn-icon-split" onclick="ubahLetak(this, '+rownum+')">\
                      <span class="text" id="kredit">Kredit</span>\
                    </button>\
                  </div>',
                '<div id="'+jenisAkun+'_tambah_'+rownum+'">\
                    <button class="btn btn-success btn-icon-split" onclick="ubahLetak(this, '+rownum+')">\
                      <span class="text" id="debet">Debet</span>\
                    </button>\
                  </div>',
                colAktiv

              ]).draw();
            }          
            //-------------------------------------------------------------

            document.getElementById('tambahAkun').value="";

           

          }

        </script>


        
