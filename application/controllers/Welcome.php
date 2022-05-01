<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
 
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array(
            "session",
            "email"
        ));

        $this->load->helper(array(
            'form',
            'url','faicon'
        ));

        $this->load->model(array(
            "Lostandfound_db","Stat_db"
        ));
    }

    public function index()
    {
        
        $str = '';
        $data['results'] = $this->Lostandfound_db->getitem($str);
        
        $this->load->view('template/welcome_header');
        $this->load->view('welcome_message',$data);
        $this->load->view('template/welcome_footer');
    }

    public function about()
    {
        $data['subscriptions'] = $this->subscription_db->gettotalsubscriptions();
        $this->load->view('template/welcome_header');
        $this->load->view('about', $data);
        $this->load->view('template/welcome_footer');
    }

    public function additem($processed = 0)
    {
        if ($processed == 1) {
            $this->session->set_flashdata('success', 'Thanks for adding item to the lost&found database');
        }

        $this->load->view('template/welcome_header');
        $this->load->view('additem');
        $this->load->view('template/welcome_footer');
    }

    public function submit_additem()
    {
        $data = $this->input->post();

        $data['date_added'] = date("Y-m-d H:i:s");

        $this->Lostandfound_db->additem($data);
        
        
        
        // START BROADCAST
        
        //send email out
        $keyword = "email";
        $url_subscriptions = (ENVIRONMENT == 'development') ? "http://localhost:8888/ngonyamalinkwebsite/index.php/welcome/get_subscriptions_json" : "https://www.ngonyamalink.co.za/infiniteshops/index.php/welcome/get_subscriptions_json";
        $json = file_get_contents($url_subscriptions . "/" . $keyword);
        $emails =  json_decode($json, true);
        
        
        //send sms out
        $keyword = "phone";
        $url_subscriptions = (ENVIRONMENT == 'development') ? "http://localhost:8888/ngonyamalinkwebsite/index.php/welcome/get_subscriptions_json" : "https://www.ngonyamalink.co.za/infiniteshops/index.php/welcome/get_subscriptions_json";
        $json = file_get_contents($url_subscriptions . "/" . $keyword);
        $phones =  json_decode($json, true);
        
        // send email push notifications
        
        $email_string = 'info@ngonyamalink.co.za';
        
        $cnt = 0;
        
        foreach ( $emails as $value) {
            $cnt = $cnt + 1;
            $email_string = $email_string . "," . $value['email'];
        }
        
        if ($email_string != NULL) {
            
            echo ("Email Receipients : " . $email_string);
            
            $this->email->from('no-reply@ngonyamalink.co.za', 'NginyamaLink Wesbite');
            $this->email->bcc($email_string);
            $this->email->subject("Lost & Found : ".$data['itemtype']);
            $this->email->message($data['itemtype'] . "  has been recorded on our database as : ".$data['itemdescription'].". To locate it please proceed to search using keywords https://www.ngonyamalink.co.za/lostandfound");
            $this->email->send();
        }
        
        sleep(3);
        
        $textmessage = str_replace(" ", "+",  $data['itemtype'] . "  has been recorded on our database as : ".$data['itemdescription'].". To locate it please proceed to search using keywords https://www.ngonyamalink.co.za/lostandfound");
        
        
        
        // send sms push notifications
        echo "<br/><br/>";
        
        $phone_string = '+27633861016';
        $cnt = 0;
        foreach ($phones as $value) {
            $cnt = $cnt + 1;
            $phone_string = $phone_string . "," . $value['phone'];
        }
        
        $phone_string = substr($phone_string, 1, strlen($phone_string));
        
        if ($phone_string != NULL) {
            
            echo ("SMS Receipients : " . $phone_string);
            
            $url = "https://platform.clickatell.com/messages/http/send?apiKey=uqTlIWcPRviI0IGfaVtBgg==&to=+27713022315&content=$textmessage.";
            
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            var_dump($response);
            
    
        }
        
        // END BROADCAST
            
        redirect(base_url("index.php/welcome/additem/1"));
    }

    public function finditem()
    {
        $data = $this->input->post();
        $data['date_added'] = date("Y-m-d H:i:s");
        $str = $data['keyword'];
        $data = NULL;
        $data['results'] = $this->Lostandfound_db->getitem($str);
        $this->load->view('template/welcome_header');
        $this->load->view('welcome_message', $data);
        $this->load->view('template/welcome_footer');
    }

    public function retrieve($processed = 0, $item_id = 0)
    {
        
        if ($processed == 1) {
            $this->session->set_flashdata('success', 'You have successfully submitted your retrieval request. Our call center will be in touch.');
        }
        $data['item_id'] = $item_id;
        $this->load->view('template/welcome_header');
        $this->load->view('retrieve', $data);
        $this->load->view('template/welcome_footer');
    }

    public function submit_retrieve()
    {
        $fdata = $this->input->post();

        // unset($data['userfile']);
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "2048000777777",
            'max_height' => "768555",
            'max_width' => "1024555",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("userfile")) {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

            $fdata['attachment_url'] = $attachment_url;
        }

        $fdata['date_added'] = date("Y-m-d H:i:s");
        $data['results'] = $this->Lostandfound_db->additemretrievalrequest($fdata);

        redirect(base_url('welcome/retrieve/1/'.$fdata['item_id']));
    }

    public function careers()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('careers');
        $this->load->view('template/welcome_footer');
    }

    public function feedback_form($processed = 0)
    {
        if ($processed == 1) {
            $this->session->set_flashdata('success', 'You have successfully submitted your feedback to Ngonyama Link. We appreciate your contribution.');
        }

        $this->load->view('template/welcome_header');
        $this->load->view('feedback_form');
        $this->load->view('template/welcome_footer');
    }

    public function submit_feedback()
    {
        $data = $this->input->post();

        if (strlen($data['email']) == 0) {
            redirect(base_url());
        } else {

            sleep(2);
            $this->email->from($data['email'], 'Feedback');
            $this->email->to('info@ngonyamalink.co.za');
            $this->email->subject('Ngonyama Link Website : Feedback ' . $data['subject']);
            $this->email->message($data['message'] . " # " . $data['phone'] . " # " . $data['fullnames'] . ' # ' . $data['email']);

            $this->email->send();

            sleep(2);

            unset($data['message']);
            unset($data['subject']);
            $data['date_added'] = date("Y-m-d H:i:s");

            $this->subscription_db->add_subscription($data);

            redirect(base_url("welcome/feedback_form/1"));
        }
    }

    public function services($id = 0)
    {
        $data['serviceid'] = $id;
        $this->load->view('template/welcome_header');
        $this->load->view('services', $data);
        $this->load->view('template/welcome_footer');
    }

    public function submit_tell_a_friend()
    {
        $data = $this->input->post();

        if (strlen($data['email']) == 0) {
            redirect(base_url());
        } else {

            $this->email->from('ngonyamalink-noreply@ngonyamalink.co.za', 'ngonyamalink-noreply');
            $this->email->to($data['email']);
            // $this->email->cc('another@another-example.com');
            $this->email->bcc('ngonyamalink@gmail.com');

            $this->email->subject('NgonyamaLink-Friend-Referral');
            $this->email->message('Hi ' . $data['email'] . ', Your friends are referring you to start using NgonyamaLink. The link is ' . base_url() . ' Warmest regards, Ngonyama Link Marketing.');

            $this->email->send();

            sleep(5);

            $data['fullnames'] = '.';
            $data['phone'] = '.';

            $data['date_added'] = date("Y-m-d H:i:s");

            $this->subscription_db->add_subscription($data);

            redirect(base_url("welcome/tell_a_friend_form/1"));
        }
    }

    public function tell_a_friend_form($processed = 0)
    {
        if ($processed == 1) {
            $this->session->set_flashdata('success', 'You have successfully referred your friend to Ngonyama Link. We appreciate your contribution.');
        }

        $this->load->view('template/welcome_header');
        $this->load->view('tell_a_friend_form');
        $this->load->view('template/welcome_footer');
    }

    public function tell_a_friend_thankyou()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('tell_a_friend_thankyou');
        $this->load->view('template/welcome_footer');
    }

    public function privacypolicy()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('privacypolicy');
        $this->load->view('template/welcome_footer');
    }

    public function termsandconditions()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('termsandconditions');
        $this->load->view('template/welcome_footer');
    }

    public function products()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('products');
        $this->load->view('template/welcome_footer');
    }

    public function team()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('team');
        $this->load->view('template/welcome_footer');
    }

    public function subscribe()
    {
        $data = $this->input->post();

        $data['date_added'] = date("Y-m-d H:i:s");

        if (strlen($data['email']) == 0 && strlen($data['phone']) == 0) {
            redirect(base_url());
        } else {

            $this->subscription_db->add_subscription($data);

            $this->email->from('ngonyamalinkwebsite@ngonyamalink.co.za', 'ngonyamalinkwebsite');
            $this->email->to('ngonyamalink@gmail.com');
            $this->email->bcc('ndlovmbu@gmail.com');

            $this->email->subject('NgonyamaLink Website Subscription');
            $this->email->message('Name : ' . $data['fullnames'] . ', Phone : ' . $data['phone'] . ' , Email : ' . $data['email']);

            $this->email->send();

            sleep(3);

            $this->email->from('no-reply@ngonyamalink.co.za', 'Ngonyama Link Website');
            $this->email->to($data['email']);
            $this->email->subject('NgonyamaLink Website Subscription');
            $this->email->message('Hi , ' . $data['fullnames'] . ', . Thank you for subscribing to Ngonyama Link Website. We will keep you updated with the latest. Visit www.ngonyamalink.co.za');

            $this->email->send();

            redirect(base_url('welcome/index/subscribed'));
        }
    }

    public function addbannerview($banner_id)
    {
        $data['banner_id'] = $banner_id;

        $data['date_added'] = date("Y-m-d H:i:s");

        $this->BannerView_db->add_bannerview($data);

        redirect(base_url());
    }

    public function sendservicerequest()
    {
        $data = $this->input->post();

        $this->email->from($data['email'], 'Service Request');
        $this->email->to('info@ngonyamalink.co.za');

        $this->email->subject('Ngonyama Link Website >>> Service Request >>> ' . $data['servicerequested']);
        $this->email->message($data['message'] . " # " . $data['phone'] . " # " . $data['fullnames'] . ' # ' . $data['email']);

        $this->email->send();

        redirect(base_url("welcome/services"));
    }
    
    
    public function lostandfound_json($keyword = NULL){
        echo json_encode($this->Lostandfound_db->getitem($keyword));
    }
    
    
    public function lostandfound_stat_json(){
        echo json_encode($this->Stat_db->get_stat());
    } 
}
