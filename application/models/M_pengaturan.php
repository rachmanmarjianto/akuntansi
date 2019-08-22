<?php
class M_pengaturan extends CI_Model{

    function __construct()
	{
		parent::__construct();
		$this->load->database();
    }
    
    public function tambahAkun($data)
    {
        $sql="insert into namaAkun value('',(select id from jenisakun where nama='".$data['jenisAkun']."'), 
            '".$data['akun']."', ".$data['tambahDengan'].", 1)";
        
        if($this->db->query($sql))
            echo 0;
        else
            echo 1;
    }

    public function prepJenisAkun()
    {
        $query=$this->db->get('jenisakun');

        $jsondata='{"jenisAkun":[';

        $i=0;

        foreach($query->result_array() as $row)
        {
            if($i>0)
                $jsondata = $jsondata.',';

            $jsondata = $jsondata.'{"id":"'.$row['id'].'", "nama":"'.$row['nama'].'"}';

            $i++;
        }

        $jsondata = $jsondata.']}';

        return $jsondata;
    }

    public function getAllNamaAkun()
    {
        $query=$this->db->get('jenisakun');

        $jenisakun = array();
        foreach($query->result_array() as $row)
        {
            $jenisakun[$row['id']]=$row['nama'];
        }

        $this->db->order_by('id_jenisAkun', 'ASC');
        $queryNA = $this->db->get('namaakun');

        $jsondata='{';
        $x=0;
        $y=0;
        $idJA = 0;
        foreach($queryNA->result_array() as $row)
        {
            if($idJA != $row['id_jenisAkun'])
            {
                $y=0;
                $idJA = $row['id_jenisAkun'];
                if($x>0)
                {
                    $jsondata = $jsondata.'],';
                }

                $jsondata = $jsondata.'"'.$jenisakun[$row['id_jenisAkun']].'":[';
                
                $x++;
            }

            if($y>0)
            {
                $jsondata = $jsondata.',';
            }

            $jsondata = $jsondata.'{"id":"'.$row['id'].'", "namaAkun":"'.$row['nama'].'", "tambahDengan":"'.$row['tambahDengan'].'", "aktiv":"'.$row['status'].'"}';

            $y++;
        }

        $jsondata = $jsondata.']}';

        return $jsondata;
    }

    public function activateAkun($data)
    {  
        $sql="UPDATE namaakun SET status = ".$data['curstatus']." WHERE nama ='".$data['namaAkun']."'";

        if($this->db->query($sql))
            echo 0;
        else
            echo 1;
    
    }

}
?>