<?php
class Image extends CI_Controller
{
    public function index($id)
    {
        $error='';
        $data=array();
        $data['id']=$id;
        $data['error']=$error;
        $this->load->model('image_model');
        $images=$this->image_model->getAll($id);
        $data['images']=$images;
        $this->load->view('admin/image/gallery',$data);
    }
    public function do_upload($id)
    {
        $error='';
        $data['id']=$id;
        $data=array();
        $data['error']=$error;

        $config['upload_path'] = './uploads/teams/images';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['file_name'] =sha1(time());
        $this->load->library('upload', $config);
//        $this->upload->file_name=sha1(time()). $this->upload->file_ext;

        if ( ! $this->upload->do_upload('image'))
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->model('image_model');
            $images=$this->image_model->getAll($id);
            $data['images']=$images;
            $this->load->view('admin/image/gallery',$data);
        }
        else
        {
//            $data = array('upload_data' => $this->upload->data());



            $this->load->model('image_model');
            $title=isset($_POST['title'])?trim($_POST['title']):'';
            $insertData=array(
                'team_id'=>$id,
                'image_name'=>$this->upload->file_name,
                'title'=>$title,
            );
            $this->image_model->create($insertData);

            $this->index($id);
        }

    }
    public function delete($id)
    {
        $this->load->model('image_model');
        $image=$this->image_model->getOne($id);
        unlink("uploads/teams/images/{$image->image_name}");
        $teamId=$image->team_id;
        $this->image_model->delete($id);
        $this->index($teamId);
    }
}