<html>
    <head></head>
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
        <script src="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css"></script>
        <style>
            .truncate {
                width: 250px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
    <body>
        <div class="table-responsive">
        <table id="tabel" class="display nowrap table-striped table-bordered table " cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Satuan Kerja</th>
                    <th>Posisi Yang Dipilih</th>
                    <th>Bahasa Pemrograman Yang Dikuasai</th>
                    <th>Framework</th>
                    <th>Database Yang Dikuasai</th>
                    <th>Tools Dikuasai</th>
                    <th>Mobile Apps</th>
                    <th>Nilai T1</th>
                    <th>Nilai T2</th>
                    <th>Nilai T3</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $json = file_get_contents('http://103.226.55.159/json/data_rekrutmen.json');
                $arr = json_decode($json,true);
                
                $json2 = file_get_contents('http://103.226.55.159/json/data_attribut.json');
                $arr2 = json_decode($json2,true);
                $count = 1;

                foreach ($arr["Form Responses 1"] as $form_response) {
                    echo "<tr>
                        <td>".$count++."</td>
                        <td>".$form_response["nama"]."</td>
                        <td>".$form_response["nip"]."</td>
                        <td>".$form_response["satuan_kerja"]."</td>
                        <td>".$form_response["posisi_yang_dipilih"]."</td>
                        <td class='truncate'>".$form_response["bahasa_pemrograman_yang_dikuasai"]."</td>";
                    if (isset($form_response["framework_bahasa_pemrograman_yang_dikuasai"])) {
                        echo "<td>".$form_response["framework_bahasa_pemrograman_yang_dikuasai"]."</td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "<td>".$form_response["database_yang_dikuasai"]."</td>
                        <td>".$form_response["tools_yang_dikuasai"]."</td>
                        <td>".$form_response["pernah_membuat_mobile_apps"]."</td>";
                        
                    foreach ($arr2 as $attribut) {
                        if($attribut["id_pendaftar"] == $form_response["id"]){
                            if ($attribut["jenis_attr"] != "url_file") {
                                echo "<td>".$attribut["value"]."</td>";
                            } else {
                                echo "<td><a href='".$attribut["value"]."' target='_blank'>Download</a></td>";
                            }
                        } 
                        // else {
                        //     continue;
                        // }
                    }
                    echo "</tr>";
                }
                // echo $obj->access_token;
            ?>
            </tbody>

        </table>
        </div>
    </body>
</html>



<script>
    var table;
    $(document).ready(function(){
        table = $('#tabel').DataTable({
            responsive: true
        });
    });
</script>