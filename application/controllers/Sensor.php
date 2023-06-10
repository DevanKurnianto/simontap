<?php
class Sensor extends CI_Controller
{
    //  public function save() {
    //     // Retrieve the data from the request
    //     $suhu = $this->input->post('suhu');
    //     $udara = $this->input->post('udara');
    //     $alkohol = $this->input->post('alkohol');
    //     $berat = $this->input->post('berat');

    //     // Perform any necessary validation or data processing

    //     // Insert the data into the database
    //     $data = array(
    //         'suhu' => $suhu,
    //         'udara' => $udara,
    //         'alkohol' => $alkohol,
    //         'berat' => $berat
    //     );
    //     $this->db->insert('sensor_data', $data);

    //     // Provide a response
    //     $response = array('status' => 'success', 'message' => 'Data saved successfully');
    //     $this->output->set_content_type('application/json')->set_output(json_encode($response));
    // }
    public function save()
    {
        //url
        // http://localhost/monitoring_tape/sensor/save?suhu=nilai&udara=nilai&alkohol=nilai&berat=nilai


        $suhu = $this->input->post('suhu');
        $udara = $this->input->post('udara');
        $alkohol = $this->input->post('alkohol');
        $berat = $this->input->post('berat');

        $data = [
            'suhu' => $suhu,
            'udara' => $udara,
            'alkohol' => $alkohol,
            'berat' => $berat,
            'status' => 1
        ];

        if ($data) {
            $this->db->insert('tbl_sensor', $data);
            echo 'data berhasil masuk';
        } else {
            echo 'data gagal masuk';
        }
    }
}
